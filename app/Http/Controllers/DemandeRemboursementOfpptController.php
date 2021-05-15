<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DemandeRemboursementOfppt;
class DemandeRemboursementOfpptController extends Controller
{
    public function index(){
        return view('DRB_Ofppt.view');
    }
    // public function edit(Request $request, $n_drf){
    //     $pln = DemandeRemboursementOfppt::findOrFail($n_drf);
    //     return view('DRB_Ofppt.edit',['pln '=>$pln ]);
    // }

    //liste de demande de remboursement 
    public function Show(){
        $pln = DemandeRemboursementOfppt::All();
        return response()->json($pln);
    }

    public function edit(Request $request ){
    //     $n_drf = DemandeRemboursementOfppt::select('demande_remboursement_ofppts.*')
    //         ->where(['demande_remboursement_ofppts.n_drf', $n_drf])
    //         ->first();
    //   return view('DRB_OFPPT.edit', ['n_drf' => $n_drf]);
    return view('DRB_OFPPT.edit');
    }

    public function update(Request $request, $n_drf)
    {
        if ($request -> isMethod('POST')) {

            // $request->validate([
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // 'mod5' =>'accepted',
            // ]);

            $drb = DemandeRemboursementOfppt::select('demande_remboursement_ofppts.*')
              ->from('demande_remboursement_ofppt')
              ->where('n_drf', $n_drf)
              ->first();


              $docs = [
              'model5',
              'model6',
              'accuse_model6',
              'fiche_eval_sythetique',
              'factures',
              'compris_cheques',
              'compris_remise',
              'relev_bq_societe',
              'relev_bq_cabinet'];

            foreach ($docs as $doc) {
                if ($request->input($doc) != null) {
                    $drb->$doc = 'préparé';
                }
                else {
                    $drb->$doc = "non préparé";
                }
            }
            $drb->date_depot_dmd_rembrs = $request->input('date_depot_dmd_rembrs');
            $drb->montant_rembrs = $request->input('montant_rembrs');
            $drb->date_rembrs = $request->input('date_rembrs');

            $drb->save();

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
