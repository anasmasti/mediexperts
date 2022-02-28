<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Client,Giac,Actionnaire,DemandeFinancement,DemandeRemboursementOfppt,PlanFormation};
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
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

        $client = Client::orderBy('created_at' , 'desc')->get();
        $giac = Giac::all();
        $action = Actionnaire::all();
        $df = DemandeFinancement::all();
        $drb = DemandeRemboursementOfppt::all();
        $plan = PlanFormation::all();

        return view('client.view',
        [
            'client'=>$client,
            'giac'=>$giac,
            'action'=>$action,
            'df'=>$df,
            'drb'=>$drb,
            'plan'=>$plan
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

    public function searchclient(Request $request)
    {   $searchclient = $request->input ('searchclient');
        $client = Client::where('raisoci', 'LIKE', '%'. $searchclient . '%')
                    ->orWhere('nrc_entrp', 'LIKE', '%'. $searchclient . '%')
                    ->get();

        $action = Actionnaire::all();
        $df = DemandeFinancement::all();
        $drb = DemandeRemboursementOfppt::all();
        $plan = PlanFormation::all();

        return view('client.view', [
            'client'=>$client,
            'action'=>$action,
            'df'=>$df,
            'drb'=>$drb,
            'plan'=>$plan
        ]);
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

            $request->validate([
                'nrc_entrp'=> 'required|unique:clients|max:20',
                'raisoci'=> 'required|unique:clients|max:100',
                'rais_abrev'=> 'required|unique:clients|max:8',
                'formjury' => 'required|max:50',
                'dt_creat' => 'required|date|before:'.date('Y-m-d'),
                'obj_soci' => 'required|max:150',
                'capt_soci' => 'required|max:200',
                'sect_activ' => 'required|max:50',
                'giac_rattach'=> 'required|max:50',
                'ice'=> 'required|unique:clients|max:50',
                'id_fiscal'=> 'required|unique:clients|max:15',
                'ncnss' => 'required|unique:clients|max:15',
                'npatente' => 'required|unique:clients|max:8',
                'sg_soci' => 'required|max:100',
                'local_2'=> 'required|max:100',
                'ville'=> 'required|max:100',
                'chif_aff_1'=> 'nullable|max:25',
                'chif_aff_2'=> 'nullable|max:25',
                'chif_aff_3'=> 'nullable|max:25',
                'chif_aff_4'=> 'nullable|max:25',
                'effectif'=> 'required|max:5',
                'mass_salar'=> 'max:15',
                'tax_form_pers'=> 'max:15',
                'der_annee_csf' => 'min:4|starts_with:20',
                'nb_permanent'=> 'required|max:5',
                'nb_occasional'=> 'required|max:3',
                'nb_ouvrier'=> 'required|max:3',
                'nb_cadre'=> 'required|max:3',
                'tel_1'=> 'required|max:14',
                'tel_2'=> 'max:14',
                'fix_1'=> 'required|max:14',
                'fix_2'=> 'max:14',
                'fax_1'=> 'max:14',
                'fax_2'=> 'max:14',
                'website'=> 'unique:clients|max:90',
                'nom_dg1'=> 'required|max:50',
                'fonct_dg1'=> 'required|max:50',
                'gsm_dg1'=> 'max:50',
                'email_dg1'=> 'max:50',
                'nom_dg2'=> 'max:50',
                'fonct_dg2'=> 'max:50',
                'gsm_dg2'=> 'max:14',
                'email_dg2'=> 'max:50',
                'nom_resp'=> 'required|max:50',
                'fonct_resp'=> 'required|max:50',
                'gsm_resp'=> 'max:14',
                'email_resp'=> 'max:50',
                'rib'=> 'unique:clients|max:30',
                'agence_banc'=> 'max:30',
                'estim_bgd_DS'=> 'max:15',
                'estim_bdg_IF'=> 'max:15',
                'estim_bdg_PF'=> 'max:15',
                'dt_relation'=> 'required|date|before_or_equal:'.date('Y-m-d'),
                'commentaire'=> 'max:4000'
            ]);
            //1
            if ($request->input('IF1_1')==null && $request->input('DS1_2')==null && $request->input('PF1_3')==null) {
                $request->validate([ 'annee_deja1'=> 'nullable' ]);
            }
            else { $request->validate([ 'annee_deja1'=> 'required|min:4|starts_with:20' ]); }
            //2
            if ($request->input('IF2_1')==null && $request->input('DS2_2')==null && $request->input('PF2_3')==null) {
                $request->validate([ 'annee_deja2'=> 'nullable' ]);
            }
            else { $request->validate([ 'annee_deja2'=> 'required|min:4|starts_with:20' ]); }
            //3
            if ($request->input('IF3_1')==null && $request->input('DS3_2')==null && $request->input('PF3_3')==null) {
                $request->validate([ 'annee_deja3'=> 'nullable' ]);
            }
            else { $request->validate([ 'annee_deja3'=> 'required|min:4|starts_with:20' ]); }

            $client = new Client();
            $client->nrc_entrp = $request->input('nrc_entrp');
            $client->raisoci = $request->input('raisoci');
            $client->rais_abrev = ucfirst($request->input('rais_abrev'));
            $client->formjury = $request->input('formjury');
            $client->dt_creat = $request->input('dt_creat');
            $client->obj_soci = $request->input('obj_soci');
            $client->capt_soci = $request->input('capt_soci');
            $client->sect_activ = $request->input('sect_activ');
            $client->giac_rattach = $request->input('giac_rattach');
            $client->ice = $request->input('ice');
            $client->id_fiscal = $request->input('id_fiscal');
            $client->ncnss = $request->input('ncnss');
            $client->npatente = $request->input('npatente');
            $client->chif_aff_1 = $request->input('chif_aff_1');
            $client->chif_aff_2 = $request->input('chif_aff_2');
            $client->chif_aff_3 = $request->input('chif_aff_3');
            $client->chif_aff_4 = $request->input('chif_aff_4');
            $client->sg_soci = $request->input('sg_soci');
            $client->local_2 = $request->input('local_2');
            $client->ville = $request->input('ville');
            $client->effectif = $request->input('effectif');
            $client->mass_salar = $request->input('mass_salar');
            $client->tax_form_pers = $request->input('tax_form_pers');
            $client->der_annee_csf = $request->input('der_annee_csf');
            $client->nb_permanent = $request->input('nb_permanent');
            $client->nb_employe = $request->input('nb_employe');
            $client->nb_occasional = $request->input('nb_occasional');
            $client->nb_ouvrier = $request->input('nb_ouvrier');
            $client->nb_cadre = $request->input('nb_cadre');

            $miss = array('IF1_1','DS1_2','PF1_3','IF2_1','DS2_2','PF2_3','IF3_1','DS3_2','PF3_3');
            foreach ($miss as $m) {
                if ($request->input($m) !== null) {
                    $client->$m = $request->input($m);
                }
                else {
                    $client->$m = "non réalisée";
                }
            }

            $client->annee_deja1 = $request->input('annee_deja1');
            $client->annee_deja2 = $request->input('annee_deja2');
            $client->annee_deja3 = $request->input('annee_deja3');
            $client->tel_1 = $request->input('tel_1');
            $client->tel_2 = $request->input('tel_2');
            $client->fix_1 = $request->input('fix_1');
            $client->fix_2 = $request->input('fix_2');
            $client->fax_1 = $request->input('fax_1');
            $client->fax_2 = $request->input('fax_2');
            $client->website = $request->input('website');
            $client->nom_dg1 = $request->input('nom_dg1');
            $client->fonct_dg1 = $request->input('fonct_dg1');
            $client->gsm_dg1 = $request->input('gsm_dg1');
            $client->email_dg1 = $request->input('email_dg1');
            $client->nom_dg2 = $request->input('nom_dg2');
            $client->fonct_dg2 = $request->input('fonct_dg2');
            $client->gsm_dg2 = $request->input('gsm_dg2');
            $client->email_dg2 = $request->input('email_dg2');
            $client->nom_resp = $request->input('nom_resp');
            $client->fonct_resp = $request->input('fonct_resp');
            $client->gsm_resp = $request->input('gsm_resp');
            $client->email_resp = $request->input('email_resp');
            $client->rib = $request->input('rib');
            $client->agence_banc = $request->input('agence_banc');
            $client->estim_bgd_DS = $request->input('estim_bgd_DS');
            $client->estim_bdg_IF = $request->input('estim_bdg_IF');
            $client->estim_bdg_PF = $request->input('estim_bdg_PF');
            $client->dt_relation = $request->input('dt_relation');
            $client->commentaire = $request->input('commentaire');
            $client->save();

            $giac = Giac::all();

            $count_action = Actionnaire::where('nrc_e', '=', $request->input('nrc_entrp'))->get();
            if (count($count_action) == 0) {
                $request->session()->flash('warning', 'Veuillez associer des actionnaires à ce client !');
            }
            $request->session()->flash('added', 'Ajouté avec succès');
        return view('client.add', ['giac'=>$giac])->with('success');
        }
        else {
            $giac = Giac::all();
            return view('client.add', ['giac'=>$giac]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $nrc_e)
    {
        $client = Client::findOrFail($nrc_e);

        $giac = Giac::all();
        $action = Actionnaire::all();
        $df = DemandeFinancement::all();
        $drb = DemandeRemboursementOfppt::all();
        $plan = PlanFormation::all();

    return view('client.detail',
            [
                'client'=>$client,
                'giac'=>$giac,
                'action'=>$action,
                'df'=>$df,
                'drb'=>$drb,
                'plan'=>$plan
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
    public function update(Request $request, $nrc_e)
    {
        if ($request -> isMethod('POST')) {
            $client = Client::findOrFail($nrc_e);

            $request->validate([
                'raisoci'=> 'required|max:100|unique:clients,raisoci,'.$client->nrc_entrp.',nrc_entrp',
                'rais_abrev'=> 'required|max:8|unique:clients,rais_abrev,'.$client->nrc_entrp.',nrc_entrp',
                'formjury' => 'required|max:50',
                'dt_creat' => 'required|date|before:'.date('Y-m-d'),
                'obj_soci' => 'required|max:150',
                'capt_soci' => 'required|max:200',
                'sect_activ' => 'required|max:50',
                'giac_rattach'=> 'required|max:50',
                'ice'=> 'required|max:50|unique:clients,ice,'.$client->nrc_entrp.',nrc_entrp',
                'id_fiscal'=> 'required|max:15|unique:clients,id_fiscal,'.$client->nrc_entrp.',nrc_entrp',
                'ncnss' => 'required|max:15|unique:clients,ncnss,'.$client->nrc_entrp.',nrc_entrp',
                'npatente' => 'required|max:8|unique:clients,npatente,'.$client->nrc_entrp.',nrc_entrp',
                'sg_soci' => 'required|max:100',
                'local_2'=> 'required|max:100',
                'ville'=> 'required|max:100',
                'chif_aff_1'=> 'nullable|max:25',
                'chif_aff_2'=> 'nullable|max:25',
                'chif_aff_3'=> 'nullable|max:25',
                'chif_aff_4'=> 'nullable|max:25',
                'effectif'=> 'required|max:5',
                'mass_salar'=> 'max:15',
                'tax_form_pers'=> 'required|max:15',
                'der_annee_csf' => 'required|min:4|starts_with:20',
                'nb_permanent'=> 'required|max:5',
                'nb_employe'=> 'required|max:3',
                'nb_occasional'=> 'required|max:3',
                'nb_ouvrier'=> 'required|max:3',
                'nb_cadre'=> 'required|max:3',
                'tel_1'=> 'required|max:20',
                'tel_2'=> 'max:14',
                'fix_1'=> 'max:20',
                'fix_2'=> 'max:14',
                'fax_1'=> 'max:20',
                'fax_2'=> 'max:14',
                'website'=> 'max:50|unique:clients,website,'.$client->nrc_entrp.',nrc_entrp',
                'nom_dg1'=> 'required|max:50',
                'fonct_dg1'=> 'required|max:50',
                'gsm_dg1'=> 'max:50',
                'email_dg1'=> 'max:50',
                'nom_dg2'=> 'max:50',
                'fonct_dg2'=> 'max:50',
                'gsm_dg2'=> 'max:14',
                'email_dg2'=> 'max:50',
                'nom_resp'=> 'required|max:50',
                'fonct_resp'=> 'required|max:50',
                'gsm_resp'=> 'max:20',
                'email_resp'=> 'max:50',
                'rib'=> 'max:30|unique:clients,rib,'.$client->nrc_entrp.',nrc_entrp',
                'agence_banc'=> 'max:30',
                'estim_bgd_DS'=> 'max:15',
                'estim_bdg_IF'=> 'max:15',
                'estim_bdg_PF'=> 'max:15',
                'dt_relation'=> 'date|before_or_equal:'.date('Y-m-d'),
                'commentaire'=> 'max:4000'
            ]);
            //1
            if ($request->input('IF1_1')==null && $request->input('DS1_2')==null && $request->input('PF1_3')==null) {
                $request->validate(['annee_deja1' => 'nullable']);
            }
            else { $request->validate(['annee_deja1' => 'required|min:4|starts_with:20' ]); }
            //2
            if ($request->input('IF2_1')==null && $request->input('DS2_2')==null && $request->input('PF2_3')==null) {
                $request->validate(['annee_deja2' => 'nullable']);
            }
            else { $request->validate(['annee_deja2' => 'required|min:4|starts_with:20' ]); }
            //3
            if ($request->input('IF3_1')==null && $request->input('DS3_2')==null && $request->input('PF3_3')==null) {
                $request->validate(['annee_deja3' => 'nullable']);
            }
            else { $request->validate(['annee_deja3' => 'required|min:4|starts_with:20' ]); }

            // $client -> update($request->all());
            $client->raisoci = $request->input('raisoci');
            $client->rais_abrev = ucfirst($request->input('rais_abrev'));
            $client->formjury = $request->input('formjury');
            $client->dt_creat = $request->input('dt_creat');
            $client->obj_soci = $request->input('obj_soci');
            $client->capt_soci = $request->input('capt_soci');
            $client->sect_activ = $request->input('sect_activ');
            $client->giac_rattach = $request->input('giac_rattach');
            $client->ice = $request->input('ice');
            $client->id_fiscal = $request->input('id_fiscal');
            $client->ncnss = $request->input('ncnss');
            $client->npatente = $request->input('npatente');
            $client->sg_soci = $request->input('sg_soci');
            $client->local_2 = $request->input('local_2');
            $client->ville = $request->input('ville');
            $client->chif_aff_1 = $request->input('chif_aff_1');
            $client->chif_aff_2 = $request->input('chif_aff_2');
            $client->chif_aff_3 = $request->input('chif_aff_3');
            $client->chif_aff_4 = $request->input('chif_aff_4');
            $client->effectif = $request->input('effectif');
            $client->mass_salar = $request->input('mass_salar');
            $client->tax_form_pers = $request->input('tax_form_pers');
            $client->der_annee_csf = $request->input('der_annee_csf');
            $client->nb_permanent = $request->input('nb_permanent');
            $client->nb_employe = $request->input('nb_employe');
            $client->nb_occasional = $request->input('nb_occasional');
            $client->nb_ouvrier = $request->input('nb_ouvrier');
            $client->nb_cadre = $request->input('nb_cadre');


            $miss = array('IF1_1','DS1_2','PF1_3','IF2_1','DS2_2','PF2_3','IF3_1','DS3_2','PF3_3');

            foreach ($miss as $m) {
                if ($request->input($m) !== null) {
                    $client->$m = "réalisée";
                }
                else {
                    $client->$m = "non réalisée";
                }
            }

            $client->annee_deja1 = $request->input('annee_deja1');
            $client->annee_deja2 = $request->input('annee_deja2');
            $client->annee_deja3 = $request->input('annee_deja3');
            $client->tel_1 = $request->input('tel_1');
            $client->tel_2 = $request->input('tel_2');
            $client->fix_1 = $request->input('fix_1');
            $client->fix_2 = $request->input('fix_2');
            $client->fax_1 = $request->input('fax_1');
            $client->fax_2 = $request->input('fax_2');
            $client->website = $request->input('website');
            $client->nom_dg1 = $request->input('nom_dg1');
            $client->fonct_dg1 = $request->input('fonct_dg1');
            $client->gsm_dg1 = $request->input('gsm_dg1');
            $client->email_dg1 = $request->input('email_dg1');
            $client->nom_dg2 = $request->input('nom_dg2');
            $client->fonct_dg2 = $request->input('fonct_dg2');
            $client->gsm_dg2 = $request->input('gsm_dg2');
            $client->email_dg2 = $request->input('email_dg2');
            $client->nom_resp = $request->input('nom_resp');
            $client->fonct_resp = $request->input('fonct_resp');
            $client->gsm_resp = $request->input('gsm_resp');
            $client->email_resp = $request->input('email_resp');
            $client->rib = $request->input('rib');
            $client->agence_banc = $request->input('agence_banc');
            $client->estim_bgd_DS = $request->input('estim_bgd_DS');
            $client->estim_bdg_IF = $request->input('estim_bdg_IF');
            $client->estim_bdg_PF = $request->input('estim_bdg_PF');
            $client->dt_relation = $request->input('dt_relation');
            $client->commentaire = $request->input('commentaire');
            $client->save();

            // update 'lieu', 'nom_resp' on update 'clients'
            $count_plan_action = PlanFormation::select('*')
                ->join('plans', 'plan_formations.id_plan', 'plans.id_plan')
                ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
                ->where('clients.nrc_entrp', $nrc_e)
                ->count();
            if ($count_plan_action > 0) {
                DB::table('clients')
                    ->join('plans', 'clients.nrc_entrp', 'plans.nrc_e')
                    ->join('plan_formations as pf', 'plans.id_plan', 'pf.id_plan')
                    ->where('clients.nrc_entrp', $nrc_e)
                    ->update([
                        'pf.lieu' => $client->raisoci,
                        'pf.nom_resp' => $client->nom_resp
                    ]);
            }

            $count_actionnaire = Actionnaire::where('nrc_e', '=', $request->input('nrc_entrp'))->count();
            if ($count_actionnaire == 0) {
                $request->session()->flash('warning', 'Veuillez associer des actionnaires à ce client !');
            }

            $request->session()->flash('updated', 'Modifié avec succès');

        return redirect('/detail-cl/'.$nrc_e)->with('success');
        }
        else {
            $client = Client::find($nrc_e);
            $giac = Giac::all();
        return view('client.edit', ['giac'=>$giac, 'client'=>$client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $nrc_e)
    {
        $client = Client::findOrFail($nrc_e);
        $client->delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

    return redirect('/client');
    }
}
