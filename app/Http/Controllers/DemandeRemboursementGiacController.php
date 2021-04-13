<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{DemandeRemboursementGiac,DemandeFinancement,Client};
use Illuminate\Support\Facades\DB;


class DemandeRemboursementGiacController extends Controller
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

        $drb = DemandeRemboursementGiac::all();

        $client = Client::all();
        $df = DemandeFinancement::all();

        return view('DRB_Giac.view', ['drb' => $drb, 'client' => $client, 'df' => $df]);
    }

    public function FactureDrbGiac($ndrb, $nrc) {
      $drb = DemandeRemboursementGiac::select('clients.*', 'demande_financements.*', 'demande_remboursement_giacs.*')
            ->join('demande_financements', 'demande_remboursement_giacs.n_df', 'demande_financements.n_df')
            ->join('clients', 'demande_financements.nrc_e', 'clients.nrc_entrp')
            ->where([['demande_remboursement_giacs.n_drb', $ndrb], ['clients.nrc_entrp', $nrc]])
            ->first();
      return view('_formulaires.facture-drb-gc', ['drb' => $drb]);
    }
    public function SaveNFactureGiac(Request $request) {
      DB::table('demande_remboursement_giacs')
            ->where('n_drb', $request->ndrb)
            ->update(['n_facture' => $request->nFacture, 'dt_facture' => $request->dtFacture]);
      // check data
      $data = DemandeRemboursementGiac::find($request->ndrb);
      return response()->json(['msg' => "Enregistré", $data]);
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
    public function searchdrb(Request $request)
    {
        $searchdrb = $request->input ('searchdrb');
        $drb = DemandeRemboursementGiac::where('n_drb', 'LIKE', '%'. $searchdrb . '%')->get();
        return view('DRB_Giac.view', ['drb' => $drb]);
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
                'n_drb' => 'required|unique:demande_remboursement_giacs|max:15',
                'n_df' => 'required|max:50',
                'dt_pay_entrp' => 'nullable|date',
                'ref_fin' => 'nullable|max:30',
                'montant_entrp_ttc' => 'required|max:15',
                'montant_entrp_ht' => 'required|max:15',
                // 'dt_depo_drb' => 'date',
                // 'dt_rb' => 'date|after:dt_depo_drb',
                'montant_rb' => 'max:15',
                'etat' => 'required',
                'commentaire' => 'max:3000',
            ]);
                
            $drb = new DemandeRemboursementGiac();
            $drb->n_drb = $request->input('n_drb');
            $drb->n_df = $request->input('n_df');

            $docs = ['fact_cab_entr', 'relv_banc_cab', 'relv_banc_entrp', 'drb_ds', 'drb_if', 'frai_doss'];

            foreach ($docs as $doc) {
                if ($request->input($doc) !== null) {
                    $drb->$doc = $request->input($doc);
                }
                else {
                    $drb->$doc = "non préparé";
                }
            }

            $drb->dt_fact_cab_entr = $request->input('dt_fact_cab_entr');
            $drb->dt_pay_entrp = $request->input('dt_pay_entrp');
            $drb->moyen_fin = $request->input('moyen_fin');
            $drb->ref_fin = $request->input('ref_fin');
            $drb->avis_remise_fin = $request->input('avis_remise_fin');
            $drb->montant_entrp_ht = $request->input('montant_entrp_ht');
            $drb->montant_entrp_ttc = $request->input('montant_entrp_ttc');

            $drb->dt_depo_drb = $request->input('dt_depo_drb');

            $drb->dt_rb = $request->input('dt_rb');
            $drb->moyen_rb = $request->input('moyen_rb');
            $drb->ref_rb = $request->input('ref_rb');
            $drb->montant_rb = $request->input('montant_rb');
            $drb->etat = $request->input('etat');
            $drb->commentaire = $request->input('commentaire');
            $drb->save();

            $df = DemandeFinancement::all();

            $request->session()->flash('added', 'Ajouté avec succès');

        return view('DRB_Giac.add', ['df' => $df])->with('success');
        }
        else {
            $df = DemandeFinancement::all();

        return view('DRB_Giac.add', ['df' => $df]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ndrb
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ndrb)
    {
        $drb = DemandeRemboursementGiac::findOrFail($ndrb);

        $df = DemandeFinancement::all();

        return view('DRB_Giac.detail', ['drb' => $drb, 'df' => $df]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ndrb
     * @return \Illuminate\Http\Response
     */
    public function edit($ndrb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $ndrb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ndrb)
    {
        if ($request -> isMethod('POST')) {

            $request->validate([
                // 'n_df' => 'required|max:50',
                // 'part_giac' => 'required|max:10',
                'dt_pay_entrp' => 'nullable|date',
                'montant_entrp_ttc' => 'required|max:15',
                'montant_entrp_ht' => 'required|max:15',
                // 'dt_depo_drb' => 'date',
                // 'dt_rb' => 'date|after:dt_depo_drb',
                'montant_rb' => 'max:15',
                'etat' => 'required',
                'commentaire' => 'max:3000',
            ]);

            $drb = DemandeRemboursementGiac::select('demande_financements.*', 'demande_remboursement_giacs.*')
              ->join('demande_financements', 'demande_financements.n_df', 'demande_remboursement_giacs.n_df')
              ->where('demande_remboursement_giacs.n_drb', $ndrb)
              ->first();

            $docs = ['fact_cab_entr', 'relv_banc_cab', 'relv_banc_entrp', 'drb_ds', 'drb_if', 'frai_doss'];

            foreach ($docs as $doc) {
                if ($request->input($doc) !== null) {
                    $drb->$doc = $request->input($doc);
                }
                else {
                    $drb->$doc = "non préparé";
                }
            }

            $drb->dt_fact_cab_entr = $request->input('dt_fact_cab_entr');
            $drb->dt_pay_entrp = $request->input('dt_pay_entrp');
            $drb->moyen_fin = $request->input('moyen_fin');
            $drb->ref_fin = $request->input('ref_fin');
            $drb->avis_remise_fin = $request->input('avis_remise_fin');
            $drb->montant_entrp_ht = $request->input('montant_entrp_ht');
            $drb->montant_entrp_ttc = $request->input('montant_entrp_ttc');

            $drb->dt_depo_drb = $request->input('dt_depo_drb');

            $drb->dt_rb = $request->input('dt_rb');
            $drb->moyen_rb = $request->input('moyen_rb');
            $drb->ref_rb = $request->input('ref_rb');
            $drb->montant_rb = $request->input('montant_rb');
            $drb->etat = $request->input('etat');
            $drb->commentaire = $request->input('commentaire');
            $drb->save();

            $request->session()->flash('updated', 'Modifié avec succès');
        return redirect('/detail-drb-gc/'.$ndrb)->with('success');
        }
        else {
          $drb = DemandeRemboursementGiac::select('demande_financements.*', 'demande_remboursement_giacs.*')
            ->join('demande_financements', 'demande_financements.n_df', 'demande_remboursement_giacs.n_df')
            ->where('demande_remboursement_giacs.n_drb', $ndrb)
            ->first();

            $df = DemandeFinancement::all();
            $client = Client::all();

        return view('DRB_Giac.edit', ['drb' => $drb, 'df' => $df, 'client' => $client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ndrb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $ndrb)
    {
        $drb = DemandeRemboursementGiac::findOrFail($ndrb);
        $drb -> delete();
        // $df = DemandeFinancement::findOrFail($ndf);
        // $df -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/drb-gc');
    }
}
