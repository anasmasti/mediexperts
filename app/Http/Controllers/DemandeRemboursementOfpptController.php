<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{DemandeRemboursementOfppt,PlanFormation,Formation,Theme};
class DemandeRemboursementOfpptController extends Controller
{
    public function index(){
        return view('DRB_Ofppt.view');
    }
    // public function edit(Request $request, $n_drf){
    //     $pln = DemandeRemboursementOfppt::findOrFail($n_drf);
    //     return view('DRB_Ofppt.edit',['pln '=>$pln ]);
    // }

    public function editRDB($n_drf){

        $pln = DemandeRemboursementOfppt::select('demande_remboursement_ofppts.*','clients.raisoci')
        ->join('clients', 'clients.nrc_entrp', 'demande_remboursement_ofppts.nrc_entrp')
        ->where('demande_remboursement_ofppts.n_drf', $n_drf)
        ->get();
        return response()->json($pln);
    }

    public function reglementEntreprise($n_drf) {
      $reglEntrp = DemandeRemboursementOfppt::select(
        'demande_remboursement_ofppts.n_drf',
        'demande_remboursement_ofppts.id_plan',
        'plan_formations.id_plan',
        'plan_formations.n_action',
        'plan_formations.n_form',
        'plan_formations.id_thm',
        'plan_formations.bdg_total',
        'clients.raisoci',
        'plans.id_plan',
        'formations.n_form',
        'formations.n_facture',
        'themes.id_theme',
        'themes.nom_theme'
        )
      ->join('clients', 'clients.nrc_entrp', 'demande_remboursement_ofppts.nrc_entrp')
      ->join('plans', 'plans.id_plan' ,'demande_remboursement_ofppts.id_plan')
      ->join('plan_formations','plan_formations.id_plan','demande_remboursement_ofppts.id_plan')
      ->join('formations','plan_formations.n_form', 'formations.n_form')
      ->join('themes','plan_formations.id_thm','themes.id_theme')
      ->where('demande_remboursement_ofppts.n_drf', $n_drf)
      ->get();
      return response()->json($reglEntrp);
    }

    //liste de demande de remboursement
    public function Show(){
        $pln = DemandeRemboursementOfppt::All();
        return response()->json($pln);
    }

    public function edit(){
    return view('DRB_OFPPT.edit');
    }

//update demande de remboursement ofppt par envoyer le n_drf
    public function update(Request $request , $n_drf){
        if ($request -> isMethod('POST')) {
            $demandeRemboursementOFPPT = DemandeRemboursementOfppt::find($n_drf);
            $docs = ['model5',
             'model6',
              'fiche_eval_sythetique',
              'factures',
               'compris_cheques',
                'compris_remise',
                 'relev_bq_societe',
                 'relev_bq_cabinet',
                  'accuse_model6'];
                  foreach ($docs as $doc) {
              if ($request->$doc == true) {
                        $demandeRemboursementOFPPT->$doc = 'préparé';
                    }
                    else{
                        $demandeRemboursementOFPPT->$doc = "non préparé";
                    }
                }
            $demandeRemboursementOFPPT->montant_rembrs = $request->montant_rembrs ;
            $demandeRemboursementOFPPT->date_rembrs = $request->date_rembrs ;
            $demandeRemboursementOFPPT->date_depot_dmd_rembrs = $request->date_depot_dmd_rembrs ;
            $demandeRemboursementOFPPT->etat = $request->etat ;
            $demandeRemboursementOFPPT->save();
            $request->session()->flash('updated', 'Modifié avec succès');
        }
    }

    public function destroy(Request $request, $n_drf)
    {
        $drb = DemandeRemboursementOfppt::findOrFail($n_drf);
        $drb -> delete();
        // $df = DemandeFinancement::findOrFail($ndf);
        // $df -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

    }

    //
}
