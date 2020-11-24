<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\{DemandeRemboursementOfppt,Client};
use Alert;

class DemandeRemboursementOfpptController extends Controller
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

        $drb = DemandeRemboursementOfppt::all();
        $client = client::all();

        return view('DRB_Ofppt.view', ['drb' => $drb, 'client'=>$client]);
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
    public function searchofppt(Request $request)
    {   $searchofppt = $request->input ( 'searchofppt' );
        $drb = DemandeRemboursementOfppt::where('n_drb', 'LIKE', '%'. $searchofppt . '%')->get();
        //get client
        $client = Client::all();
        return view('DRB_Ofppt.view', ['drb'=>$drb, 'client'=>$client]);
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
                'n_drb' => 'required|unique:demande_remboursement_ofppts|max:15',
                'nrc_e' => 'required|max:15',
                'dt_envoi' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'dt_pay_entrp' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'montant_entrp_ttc' => 'required|max:15|gt:montant_entrp_ht',
                'montant_entrp_ht' => 'required|max:15|lt:montant_entrp_ttc',
                'dt_depo_drb' => 'required|date|before:dt_rb',
                'dt_rb' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'montant_rb' => 'required|max:15',
                'commentaire' => 'max:900'
            ]);

            $drb = new DemandeRemboursementOfppt();
            $drb->n_drb = $request->input('n_drb');
            $drb->nrc_e = $request->input('nrc_e');

            $docs = ['model5','f4','fiche_eval_synth','model6','facture_PF','remise_avis','releve',
                    'justif_paiem_entrp','justif_paiem_cab','plan_form'];

            foreach ($docs as $doc) {
                if ($request->input($doc) !== null) {
                    $drb->$doc = "préparé";
                }
                else {
                    $drb->$doc = "non préparé";
                }
            }

            $drb->dt_envoi = $request->input('dt_envoi');
            $drb->annee_csf = $request->input('annee_csf');
            $drb->dt_pay_entrp = $request->input('dt_pay_entrp');
            $drb->montant_entrp_ttc = $request->input('montant_entrp_ttc');
            $drb->montant_entrp_ht = $request->input('montant_entrp_ht');
            $drb->dt_depo_drb = $request->input('dt_depo_drb');
            $drb->dt_rb = $request->input('dt_rb');
            $drb->montant_rb = $request->input('montant_rb');
            $drb->moyen_rb = $request->input('moyen_rb');

            $drb->commentaire = $request->input('commentaire');
            $drb->save();

            $client = Client::all();

            $request->session()->flash('added', 'Ajouté avec succès');
            return view('DRB_Ofppt.add', ['drb' => $drb, 'client' => $client])->with('success');
        }
        else {
            $client = Client::all();
            $drb = DemandeRemboursementOfppt::all();

            return view('DRB_Ofppt.add', ['drb' => $drb, 'client' => $client]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ndrb, $nrc)
    {
        $drb = DemandeRemboursementOfppt::findOrFail($ndrb);

        $nrc = Client::findOrFail($nrc);
        $client = client::all();

        return view('DRB_Ofppt.detail', ['drb'=>$drb, 'client'=>$client, 'nrc'=>$nrc]);
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
    public function update(Request $request, $ndrb)
    {
        if ($request -> isMethod('POST')) {

            $request->validate([
                'nrc_e' => 'required|max:15',
                'dt_envoi' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'dt_pay_entrp' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'montant_entrp_ttc' => 'required|max:15|gt:montant_entrp_ht',
                'montant_entrp_ht' => 'required|max:15|lt:montant_entrp_ttc',
                'dt_depo_drb' => 'required|date|before:dt_rb',
                'dt_rb' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'montant_rb' => 'required|max:15',
                'commentaire' => 'max:900'
            ]);

            $drb = DemandeRemboursementOfppt::findOrFail($ndrb);

            $drb->nrc_e = $request->input('nrc_e');

            $docs = ['model5','f4','fiche_eval_synth','model6','facture_PF','remise_avis','releve',
                    'justif_paiem_entrp','justif_paiem_cab','plan_form'];

            foreach ($docs as $doc) {
                if ($request->input($doc) !== null) {
                    $drb->$doc = "préparé";
                }
                else {
                    $drb->$doc = "non préparé";
                }
            }

            $drb->dt_pay_entrp = $request->input('dt_pay_entrp');
            $drb->montant_entrp_ttc = $request->input('montant_entrp_ttc');
            $drb->montant_entrp_ht = $request->input('montant_entrp_ht');
            $drb->dt_depo_drb = $request->input('dt_depo_drb');
            $drb->dt_rb = $request->input('dt_rb');
            $drb->montant_rb = $request->input('montant_rb');
            $drb->moyen_rb = $request->input('moyen_rb');
            // //moyen paiement (if radio)
            // $drb->cheque = $request->input('cheque');
            // $drb->cheque = $request->input('ordre_virm');
            // $drb->cheque = $request->input('effet');

            $drb->commentaire = $request->input('commentaire');
            $drb->save();

            $request->session()->flash('updated', 'Modifié avec succès');
            return redirect('/detail-drb-of/'.$ndrb)->with('success');
        }
        else {
            $drb = DemandeRemboursementOfppt::findOrFail($ndrb);
            $client = Client::all();

            return view('DRB_Ofppt.edit', ['drb'=>$drb, 'client'=>$client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $ndrb)
    {
        $drb = DemandeRemboursementOfppt::findOrFail($ndrb);
        $drb -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/drb-of');
    }
}
