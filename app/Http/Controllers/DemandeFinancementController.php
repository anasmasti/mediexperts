<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{DemandeFinancement,Client,DemandeRemboursementGiac,DemandeRemboursementOfppt,MissionIntervenant,Giac};
// use Alert;
use Illuminate\Support\Facades\DB;
use App\Rules\validGiac;


class DemandeFinancementController extends Controller
{

    // ***** FORMULAIRES *****
    public function FactureDF($nrc) {
      $df = DemandeFinancement::select('clients.*', 'demande_financements.*')
            ->join('clients', 'demande_financements.nrc_e', 'clients.nrc_entrp')
            ->where('demande_financements.n_df', $nrc)
            ->first();
      return view('_formulaires.facture-df', ['df' => $df]);
    }

    public function SaveNFactureDF(Request $request) {
      DB::table('demande_financements')
            ->where('n_df', $request->ndf)
            ->update(['n_facture' => $request->nFacture, 'dt_facture' => $request->dtFacture]);
      // check data
      $data = DemandeFinancement::find($request->ndf);
      return response()->json(['msg' => "Enregistré", $data]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //clean session keys
        $request->session()->forget(['added', 'updated']);
        $request->session()->forget(['success', 'info', 'warning', 'error']);

        $df = DemandeFinancement::all();
        $client = Client::all();
        $drb = DemandeRemboursementGiac::all();
        $misinv = MissionIntervenant::all();

        return view('df.view', [
                'df' => $df,
                'client' => $client,
                'drb' => $drb,
                'misinv' => $misinv
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function searchdf(Request $request)
    {   $searchdf = $request->input ('searchdf');
        $df = DemandeFinancement::where('annee_exerc', 'LIKE', '%'. $searchdf . '%')->get();

        $client = Client::all();
        $drb = DemandeRemboursementGiac::all();
        $misinv = MissionIntervenant::all();
        return view('df.view',
        [
            'df' => $df,
            'client'=>$client,
            'drb' => $drb,
            'misinv' => $misinv
        ]);
    }
    public function DemandeGiac_DF(Request $request, $ndf) {
      $drb = DemandeRemboursementGiac::select('demande_financements.*', 'demande_remboursement_giacs.*')
        ->join('demande_financements', 'demande_financements.n_df', 'demande_remboursement_giacs.n_df')
        ->where('demande_financements.n_df', $ndf)
        ->get();

      return view('DRB_Giac.view', ['drb' => $drb]);
    }

    //search giac of client
    public function FindGiacsClient(Request $request) {
        $data = Client::select('giac_rattach', 'nrc_entrp', 'raisoci')
                ->where('nrc_entrp', $request->nrc) //'$request->nrc' is the nrc of our chosen option nrc
                // ->take(100)
                ->first();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request -> isMethod('POST')) {

            $validatePrcQuote = '';
            $validatebdgAccord = '';
            $validateJourHomeValide='';
            //pourcentage quote part required if budget accordé is not null
            if ($request->input('bdg_demande') != "") { $validatebdgAccord = '|lte:bdg_demande'; }
            if ($request->input('bdg_accord') != "") { $validatePrcQuote = 'required';  }

            $request->validate([
                'nrc_e' => 'required',
                'type_miss' => 'required|max:150',
                'annee_exerc' => 'required|min:4|starts_with:20',
                'bdg_pf' => 'nullable|max:20',
                'type_contrat' => 'nullable',
                'nb_interv' => 'nullable|max:3', //2
                'dt_df' => 'nullable|date', //2
                'jr_hm_demande' => 'nullable|max:10', //2
                'bdg_demande' => 'nullable|max:6', //2
                'prc_cote_part_demande' => 'nullable|lte:bdg_demande', //4
                'dt_depos_df' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //3+
                'dt_accord' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //4
                'dt_dep_contrat' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //4
                'dt_debut_miss' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //4
                'dt_fin_miss' => 'nullable|date|after:dt_debut_miss', //4
                'jr_hm_valid' => 'nullable|max:15', //4
                'cote_part_entrp' => 'nullable|max:15', //4
                'bdg_accord' => 'nullable|max:15|lte:bdg_demande', //4
                'prc_cote_part' => $validatePrcQuote, //4
                'dt_envoi_av' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //5
                'dt_fin_realis' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //5
                'n_contrat' => 'nullable|max:20',
                'dt_approb' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //6
                'dt_depos_rpt' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //6
                'dt_at_csf' => 'nullable|date|before_or_equal:'.date('Y-m-d'),
                'etat' => 'required|max:50',
                'commentaire' => 'max:4900'
            ]);

            $df = new DemandeFinancement();
                $ndf = $df->n_df;
            $df->nrc_e = $request->input('nrc_e');
            $df->type_miss = $request->input('type_miss');
            $df->type_contrat = $request->input('type_contrat');
            $df->gc_rattach = $request->input('gc_rattach');
            $df->nb_interv = $request->input('nb_interv');
            $df->annee_exerc = $request->input("annee_exerc");
            $df->dt_df = $request->input('dt_df');
            $df->jr_hm_demande = $request->input('jr_hm_demande');
            $df->bdg_demande = $request->input('bdg_demande');
            $df->prc_cote_part_demande = $request->input('prc_cote_part_demande');
            $df->d_bulltin_adhes = $request->input('d_bulltin_adhes');
            $df->d_df_DS = $request->input('d_df_DS');
            $df->d_df_IF = $request->input('d_df_IF');
            $df->d_cheque = $request->input('d_cheque');
            $df->f_renseign_entrp = $request->input('f_renseign_entrp');
            $df->f_etude_DS = $request->input('f_etude_DS');
            $df->f_etude_IF = $request->input('f_etude_IF');
            $df->l_tierpay_DS = $request->input('l_tierpay_DS');
            $df->l_tierpay_IF = $request->input('l_tierpay_IF');
            $df->d_honor = $request->input('d_honor');
            $df->doss_jury = $request->input('doss_jury');
            $df->at_csf_doc = $request->input('at_csf_doc');
            $df->bdg_pf = $request->input('bdg_pf');
            $df->f1 = $request->input('f1');
            $df->d_statut = $request->input('d_statut');
            $df->d_rc = $request->input('d_rc');
            $df->at_domic_banc = $request->input('at_domic_banc');
            $df->dem_csf = $request->input('dem_csf');
            $df->d_pouvoir = $request->input('d_pouvoir');
            $df->dt_at_csf = $request->input('dt_at_csf');
            $df->at_qual_cab = $request->input('at_qual_cab');
            $df->at_compte = $request->input('at_compte');
            $df->f_renseign_cab = $request->input('f_renseign_cab');
            $df->d_eligib_csf_cab = $request->input('d_eligib_csf_cab');
            $df->d_fact_proforama_ds = $request->input('d_fact_proforama_ds');
            $df->d_fact_proforama_if = $request->input('d_fact_proforama_if');
            $df->d_propal_DS = $request->input('d_propal_DS');
            $df->d_propal_IF = $request->input('d_propal_IF');
            $df->d_cv_consult_miss = $request->input('d_cv_consult_miss');
            $df->ct_DS = $request->input('ct_DS');
            $df->ct_IF = $request->input('ct_IF');
            $df->dt_depos_df = $request->input('dt_depos_df');
            $df->dt_accord = $request->input('dt_accord');
            $df->dt_dep_contrat = $request->input('dt_dep_contrat');
            $df->dt_debut_miss = $request->input('dt_debut_miss');
            $df->dt_fin_miss = $request->input('dt_fin_miss');
            $df->jr_hm_valid = $request->input('jr_hm_valid');
            $df->cote_part_entrp = $request->input('cote_part_entrp');
            $df->prc_cote_part = $request->input('prc_cote_part');
            $df->bdg_accord = $request->input('bdg_accord');
            $df->bdg_letter = $request->input('bdg_letter');
            $df->dt_envoi_av = $request->input('dt_envoi_av');
            $df->dt_fin_realis = $request->input('dt_fin_realis');
            $df->dt_approb = $request->input('dt_approb');
            $df->dt_depos_rpt = $request->input('dt_depos_rpt');
            // $df->n_contrat = $request->input('n_contrat');

            $docs = ['d_eligib_csf_entrp','d_model6_n_1','d_model6_n_2','d_honor_act_form','accus_depos',
                    'at_csf_entrp','av_realis_DS','av_realis_IF','planing_DS','planing_IF',
                    'rpt_realis','p_garde_DS','p_garde_IF','dem_approb_ds','dem_approb_if','f2',
                    'model_1','rpt_depose','at_approb'];

            foreach($docs as $doc) {
                if ($request->input($doc) != null) {
                    $df->$doc = $request->input($doc);
                }
                else {
                    $df->$doc = "non préparé";
                }
            }

            $df->etat = $request->input('etat');
            $df->commentaire = $request->input('commentaire');

            // $request->session()->flash('added', 'Ajouté avec succès');
            

            //If etat df "accordé" -> auto add new drb giac
            $etat_demande = mb_strtolower($request->input('etat'));
            $drb_gc = DemandeFinancement::select('demande_financements.*')
            ->where('demande_financements.n_df', $ndf)
            ->get();
            
        





            $checkDRB_gc_Annee_Entr =  DemandeFinancement::select('demande_financements.*')
                ->where([
                    ['annee_exerc', '=',$request->input("annee_exerc")],
                    ['nrc_e','=',$request->input('nrc_e')],
                ])
            ->get();
            $check_exist = DemandeRemboursementGiac::select('demande_remboursement_giacs.*')
            ->where('n_df', '=',$ndf)
        ->get();
           // return response()->json($check_exist);
           $etat_demande = mb_strtolower($request->input('etat'));
            $nb_DF_Entr_Anne = count($checkDRB_gc_Annee_Entr);
            $drb = new DemandeRemboursementGiac();
            // if ($df->annee_exerc != $request->input("annee_exerc") || mb_strtolower($df->type_miss) != $request->input("type_miss")  ) {
                if($nb_DF_Entr_Anne == 2){
                    //m3ndksh l7a9 tmodifier lhad la date 
                    
                    $request->session()->flash('error', 'La date et le nom de l\'entreprise existes déjà ');
                }
                else if($nb_DF_Entr_Anne == 1){
                    foreach($checkDRB_gc_Annee_Entr as $chk){
                        if($chk->type_miss ==$request->input('type_miss')){
                           // return response()->json($chk);
                            $request->session()->flash('error', 'La date et le nom de l\'entreprise existes déjà ');
    
                        }
                        else{
                            if($check_exist->isEmpty()){
                                $df->save();
                                // modifier la DRB avec les nouveaux montants et quote part
                                if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                                   
                                    $drb->n_df = $df->n_df;
                                    $drb->etat = "initié";
    
                                    $bdg_acc = $request->input('bdg_accord');
                                    $quote_part = $request->input('cote_part_entrp');
    
                                    $drb->montant_entrp_ht = $bdg_acc;
                                    $drb->montant_entrp_ttc = $quote_part;
    
                                    if ($request->input('prc_cote_part') == "20%") {
                                        $drb->montant_rb = $bdg_acc * .8;
                                        $drb->part_giac = "80%";
                                    }
                                    else if ($request->input('prc_cote_part') == "30%") {
                                        $drb->montant_rb = $bdg_acc * .7;
                                        $drb->part_giac = "70%";
                                    }
                                    $drb->save();
                                   
                                    // $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                                    $request->session()->flash('info', '2) Demande de remboursement GIAC initié');
                                }
                                
                          
                         }
                            
                            
                            $request->session()->flash('updated', 'Testdemande finanacement Ajouté avec succès');
                            
                        }
                    }
                }
                else{
                    if($check_exist->isEmpty()){
                        $df->save();  
                        // modifier la DRB avec les nouveaux montants et quote part
                        if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                            $drb->n_df = $df->n_df;
                            $drb->etat = "initié";

                            $bdg_acc = $request->input('bdg_accord');
                            $quote_part = $request->input('cote_part_entrp');

                            $drb->montant_entrp_ht = $bdg_acc;
                            $drb->montant_entrp_ttc = $quote_part;

                            if ($request->input('prc_cote_part') === "20%") {
                                $drb->montant_rb = $bdg_acc * .8;
                                $drb->part_giac = "80%";
                            }
                            else if ($request->input('prc_cote_part') === "30%") {
                                $drb->montant_rb = $bdg_acc * .7;
                                $drb->part_giac = "70%";
                            }
                            else{
                                $drb->montant_rb = $bdg_acc * .5;
                                $drb->part_giac = "50%";
                            }
                            $drb->save();
                           
                          //  $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                            $request->session()->flash('info', 'Demande de remboursement GIAC initié');
                        }
                    
                 }
                    
                    $request->session()->flash('updated', 'demande finanacement Ajouté avec succès');
                }
           
          
            //avoid undefined value client by adding this
            $client = Client::all();
            $giac = Giac::all();

        return view('df.add', ['client' => $client, 'giac' => $giac])->with('success');
        }
        else {
            $client = Client::all();
            $giac = Giac::all();
        return view('df.add', ['client' => $client, 'giac' => $giac]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ndf)
    {
        $df = DemandeFinancement::findOrFail($ndf);

        $client = Client::select('nrc_entrp', 'raisoci', 'giac_rattach')
                ->join('demande_financements', 'demande_financements.nrc_e', 'clients.nrc_entrp')
                ->where('clients.nrc_entrp', $df->nrc_e)
                ->get();

        // $gc_entrp = Client::find($df->nrc_e)->gc_rattach;

        $drb = DemandeRemboursementGiac::all();
        $misinv = MissionIntervenant::all();

        return view('df.detail', [
                'df' => $df,
                'client' => $client,
                'drb' => $drb,
                'misinv' => $misinv
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

















    public function update(Request $request, $ndf)
    {
        if ($request -> isMethod('POST')) {

            $validatePrcQuote = '';
            $validatebdgAccord = '';

            $request->validate([
                'nrc_e' => 'required',
                'type_miss' => 'required|max:150',
                'nrc_e' => 'required',
                'annee_exerc' => 'required|min:4|starts_with:20',
                'n_contrat' => 'nullable|max:20',
                'type_contrat' => 'nullable',
                'nb_interv' => 'nullable|max:3', //2
                'dt_df' => 'nullable|date', //2
                'jr_hm_demande' => 'nullable|max:15', //2
                'bdg_demande' => 'nullable|max:6', //2
                'prc_cote_part_demande' => 'nullable|lte:bdg_demande', //4
                'dt_depos_df' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //3+
                'dt_accord' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //4
                'dt_dep_contrat' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //4
                'dt_debut_miss' => 'nullable|date', //4
                'dt_fin_miss' => 'nullable|date|after:dt_debut_miss', //4
                'jr_hm_valid' => 'nullable|max:15', //4
                'cote_part_entrp' => 'nullable|max:15', //4
                'bdg_accord' => 'nullable|max:6', //4
                'prc_cote_part' => $validatePrcQuote, //4
                'dt_envoi_av' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //5
                'dt_fin_realis' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //5

                'dt_approb' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //6
                'dt_depos_rpt' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //6


                'etat' => 'required|max:50',
                'commentaire' => 'max:4900'
                ]);

            $df_count = DemandeFinancement::count();
            $df = DemandeFinancement::findOrFail($ndf);
            $df->nrc_e = $request->input('nrc_e');
            $df->gc_rattach = $request->input('gc_rattach');
            $df->nb_interv = $request->input('nb_interv');
            $df->dt_df = $request->input('dt_df');
            $df->jr_hm_demande = $request->input('jr_hm_demande');
            $df->type_contrat = $request->input('type_contrat');
            $df->bdg_demande = $request->input('bdg_demande');
            $df->prc_cote_part_demande = $request->input('prc_cote_part_demande');
            $df->d_bulltin_adhes = $request->input('d_bulltin_adhes');
            $df->d_df_DS = $request->input('d_df_DS');
            $df->d_df_IF = $request->input('d_df_IF');
            $df->d_cheque = $request->input('d_cheque');
            $df->f_renseign_entrp = $request->input('f_renseign_entrp');
            $df->f_etude_DS = $request->input('f_etude_DS');
            $df->f_etude_IF = $request->input('f_etude_IF');
            $df->l_tierpay_DS = $request->input('l_tierpay_DS');
            $df->l_tierpay_IF = $request->input('l_tierpay_IF');
            $df->d_honor = $request->input('d_honor');
            $df->doss_jury = $request->input('doss_jury');
            $df->at_csf_doc = $request->input('at_csf_doc');
            $df->bdg_pf = $request->input('bdg_pf');
            $df->f1 = $request->input('f1');
            $df->d_statut = $request->input('d_statut');
            $df->d_rc = $request->input('d_rc');
            $df->at_domic_banc = $request->input('at_domic_banc');
            $df->dem_csf = $request->input('dem_csf');
            $df->d_pouvoir = $request->input('d_pouvoir');
            $df->dt_at_csf = $request->input('dt_at_csf');
            $df->at_qual_cab = $request->input('at_qual_cab');
            $df->at_compte = $request->input('at_compte');
            $df->f_renseign_cab = $request->input('f_renseign_cab');
            $df->d_eligib_csf_cab = $request->input('d_eligib_csf_cab');
            $df->d_fact_proforama_ds = $request->input('d_fact_proforama_ds');
            $df->d_fact_proforama_if = $request->input('d_fact_proforama_if');
            $df->d_propal_DS = $request->input('d_propal_DS');
            $df->d_propal_IF = $request->input('d_propal_IF');
            $df->d_cv_consult_miss = $request->input('d_cv_consult_miss');
            $df->ct_DS = $request->input('ct_DS');
            $df->ct_IF = $request->input('ct_IF');
            $df->dt_depos_df = $request->input('dt_depos_df');
            $df->dt_accord = $request->input('dt_accord');
            $df->dt_dep_contrat = $request->input('dt_dep_contrat');
            $df->dt_debut_miss = $request->input('dt_debut_miss');
            $df->dt_fin_miss = $request->input('dt_fin_miss');
            $df->jr_hm_valid = $request->input('jr_hm_valid');
            $df->cote_part_entrp = $request->input('cote_part_entrp');
            $df->prc_cote_part = $request->input('prc_cote_part');
            $df->bdg_accord = $request->input('bdg_accord');
            $df->bdg_letter = $request->input('bdg_letter');
            $df->dt_envoi_av = $request->input('dt_envoi_av');
            $df->dt_fin_realis = $request->input('dt_fin_realis');
            $df->dt_approb = $request->input('dt_approb');
            $df->dt_depos_rpt = $request->input('dt_depos_rpt');
            $df->n_contrat = $request->input('n_contrat');

            $docs = ['d_eligib_csf_entrp','d_model6_n_1','d_model6_n_2','d_honor_act_form','accus_depos',
                    'at_csf_entrp','av_realis_DS','av_realis_IF','planing_DS','planing_IF',
                    'rpt_realis','p_garde_DS','p_garde_IF','dem_approb_ds','dem_approb_if','f2',
                    'model_1','rpt_depose','at_approb'];

            foreach($docs as $doc) {
                if ($request->input($doc) != null) {
                    $df->$doc = "préparé";
                }
                else {
                    $df->$doc = "non préparé";
                }
            }
            $drb_gc = DemandeFinancement::select('demande_financements.*')
            ->where('demande_financements.n_df', $ndf)
            ->get();
            $df->etat = $request->input('etat');
            $df->commentaire = $request->input('commentaire');

            

            //******************************************************************/
            //******************************************************************/
            //******************************************************************/
            //***************************** DRB ********************************/
            //add new record after DF->etat == "accordé et +" (à modifier)
            $drb = DemandeRemboursementGiac::all(); //all existed data
            //If etat df "accordé et +" -> auto add new DRB giac
        
            

            $checkDRB_gc_Annee_Entr =  DemandeFinancement::select('demande_financements.*')
                ->where([
                    ['annee_exerc', '=',$request->input("annee_exerc")],
                    ['nrc_e','=',$request->input('nrc_e')],
                ])
            ->get();
            $check_exist = DemandeRemboursementGiac::select('demande_remboursement_giacs.*')
            ->where('n_df', '=',$ndf)
            ->first();
           // return response()->json($check_exist);
           $etat_demande = mb_strtolower($request->input('etat'));
            $nb_DF_Entr_Anne = count($checkDRB_gc_Annee_Entr);
            $drb = new DemandeRemboursementGiac();
            if ($df->annee_exerc != $request->input("annee_exerc") || mb_strtolower($df->type_miss) != $request->input("type_miss")  ) {
                if($nb_DF_Entr_Anne == 2){
                    //m3ndksh l7a9 tmodifier lhad la date 
                    
                    $request->session()->flash('error', 'La date et le nom de l\'entreprise existes déjà ');
                }
                else if($nb_DF_Entr_Anne == 1){
                    foreach($checkDRB_gc_Annee_Entr as $chk){
                        if($chk->type_miss ==$request->input('type_miss')){
                            //m3ndksh l7a9 tmodifier lhad la date 
                           // return response()->json($chk);
                            $request->session()->flash('error', 'La date et le nom de l\'entreprise existes déjà ');
    
                        }
                        else{
                            if($check_exist === null){
                                // modifier la DRB avec les nouveaux montants et quote part
                                if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                               
                                    $drb->n_df = $df->n_df;
                                    $drb->etat = "initié";
    
                                    $bdg_acc = $request->input('bdg_accord');
                                    $quote_part = $request->input('cote_part_entrp');
    
                                    $drb->montant_entrp_ht = $bdg_acc;
                                    $drb->montant_entrp_ttc = $quote_part;
    
                                    if ($request->input('prc_cote_part') == "20%") {
                                        $drb->montant_rb = $bdg_acc * .8;
                                        $drb->part_giac = "80%";
                                    }
                                    else if ($request->input('prc_cote_part') == "30%") {
                                        $drb->montant_rb = $bdg_acc * .7;
                                        $drb->part_giac = "70%";
                                    }
                                    $drb->save();
                                   
                                    // $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                                    $request->session()->flash('info', '2) Demande de remboursement GIAC initié');
                                }
                                
                          
                         }
                         else{
                            if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                               
                              
                                

                                $bdg_acc = $request->input('bdg_accord');
                                $quote_part = $request->input('cote_part_entrp');

                                $check_exist->montant_entrp_ht = $bdg_acc;
                                $check_exist->montant_entrp_ttc = $quote_part;

                                if ($request->input('prc_cote_part') == "20%") {
                                    $check_exist->montant_rb = $bdg_acc * .8;
                                    $check_exist->part_giac = "80%";
                                }
                                else if ($request->input('prc_cote_part') == "30%") {
                                    $check_exist->montant_rb = $bdg_acc * .7;
                                    $check_exist->part_giac = "70%";
                                }
                                $check_exist->save();
                               
                                // $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                                $request->session()->flash('info', '2) Demande de remboursement GIAC initié');
                            }
                            
                         }
                            //3ndek l7a9
                            
                            $df->type_miss = $request->input('type_miss');
                            $df->annee_exerc = $request->input("annee_exerc");
                            $request->session()->flash('updated', 'demande finanacement Modifié avec succès');
                            
                        }
                    }
                }
                else{
                    if($check_exist === null){
                                
                        // modifier la DRB avec les nouveaux montants et quote part
                        if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                               
                            $drb->n_df = $df->n_df;
                            $drb->etat = "initié";

                            $bdg_acc = $request->input('bdg_accord');
                            $quote_part = $request->input('cote_part_entrp');

                            $drb->montant_entrp_ht = $bdg_acc;
                            $drb->montant_entrp_ttc = $quote_part;

                            if ($request->input('prc_cote_part') == "20%") {
                                $drb->montant_rb = $bdg_acc * .8;
                                $drb->part_giac = "80%";
                            }
                            else if ($request->input('prc_cote_part') == "30%") {
                                $drb->montant_rb = $bdg_acc * .7;
                                $drb->part_giac = "70%";
                            }
                            $drb->save();
                           
                          //  $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                            $request->session()->flash('info', 'Demande de remboursement GIAC initié');
                        }
                    
                 }
                 else{
                    if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                       
                      
                        

                        $bdg_acc = $request->input('bdg_accord');
                        $quote_part = $request->input('cote_part_entrp');

                        $check_exist->montant_entrp_ht = $bdg_acc;
                        $check_exist->montant_entrp_ttc = $quote_part;

                        if ($request->input('prc_cote_part') == "20%") {
                            $check_exist->montant_rb = $bdg_acc * .8;
                            $check_exist->part_giac = "80%";
                        }
                        else if ($request->input('prc_cote_part') == "30%") {
                            $check_exist->montant_rb = $bdg_acc * .7;
                            $check_exist->part_giac = "70%";
                        }
                        $check_exist->save();
                       
                        // $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                        $request->session()->flash('info', '2) Demande de remboursement GIAC initié');
                    }
                    
                 }
                    //3ndek l7a9
                    $df->type_miss = $request->input('type_miss');
                     $df->annee_exerc = $request->input("annee_exerc");
                    $request->session()->flash('updated', 'demande finanacement Modifié avec succès');
                }
            }
            else{
                // return response()->json($check_exist);
                if($check_exist === null){
                                
                    // modifier la DRB avec les nouveaux montants et quote part
                    if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                               
                        $drb->n_df = $df->n_df;
                        $drb->etat = "initié";

                        $bdg_acc = $request->input('bdg_accord');
                        $quote_part = $request->input('cote_part_entrp');

                        $drb->montant_entrp_ht = $bdg_acc;
                        $drb->montant_entrp_ttc = $quote_part;

                        if ($request->input('prc_cote_part') == "20%") {
                            $drb->montant_rb = $bdg_acc * .8;
                            $drb->part_giac = "80%";
                        }
                        else if ($request->input('prc_cote_part') == "30%") {
                            $drb->montant_rb = $bdg_acc * .7;
                            $drb->part_giac = "70%";
                        }
                        $drb->save();
                       
                        //$request->session()->flash('added', '1) Demande financement ajouté avec succès');
                        $request->session()->flash('info', '2) Demande de remboursement GIAC initié');
                    }
                    
             }
             else{
                if ( $etat_demande == "accordé" || $etat_demande == "réalisé" || $etat_demande == "approuvé") {
                   
                  
                    

                    $bdg_acc = $request->input('bdg_accord');
                    $quote_part = $request->input('cote_part_entrp');

                    $check_exist->montant_entrp_ht = $bdg_acc;
                    $check_exist->montant_entrp_ttc = $quote_part;

                    if ($request->input('prc_cote_part') == "20%") {
                        $check_exist->montant_rb = $bdg_acc * .8;
                        $check_exist->part_giac = "80%";
                    }
                    else if ($request->input('prc_cote_part') == "30%") {
                        $check_exist->montant_rb = $bdg_acc * .7;
                        $check_exist->part_giac = "70%";
                    }
                    $check_exist->save();
                   
                    // $request->session()->flash('added', '1) Demande financement ajouté avec succès');
                    $request->session()->flash('info', '2) Demande de remboursement GIAC initié');
                }
                
             }
                $request->session()->flash('updated', 'demande finanacement Modifié avec succès');
           
            }

             $df->save();
             
              
                            
          






            return redirect('/edit-df/'.$ndf)->with('success');












            //***************************** DRB ********************************/
            //******************************************************************/

        }

        else {
            $df = DemandeFinancement::findOrFail($ndf);

             //searching primary key
            $client = Client::all();

            return view('df.edit', ['df' => $df, 'client' => $client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $ndf)
    {
        $df = DemandeFinancement::findOrFail($ndf);
        $df -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

    return redirect('/df');
    }
}
