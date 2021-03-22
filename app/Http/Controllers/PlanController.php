<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{Plan,Client, Intervenant};
use Dotenv\Validator;

//Plan Formation
class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //clean keys session
        $request->session()->forget(['added', 'updated']);
        $request->session()->forget(['success', 'info', 'warning', 'error']);

        $plans = Plan::all();
        $client = Client::all();

        return view('plan.view', ['plans' => $plans, 'client' => $client]);
    }


    public function searchplan(Request $request)
    {   $searchplan = $request->input ( 'search_input' );
        $plans = Plan::where('refpdf', 'LIKE', '%'. $searchplan . '%')->get();
        //get client
        $client = Client::all();
        $interv = Intervenant::all();
        return view('plan.view', ['plans'=>$plans, 'client'=>$client, 'interv'=>$interv]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request -> isMethod('POST')) {

            //get data from
            $client = Client::all();

            $request->validate([
                'nrc_e' => 'required',
                'annee' => 'required|min:4|starts_with:20',
                'n_contrat' => 'nullable|max:15',

                //PF OFPPT
                'dt_contrat_PFOPT' => 'nullable|date|before_or_equal:'.date('Y-m-d'),
                'dt_accuse_PFOPT' => 'nullable|date|before_or_equal:'.date('Y-m-d'),

                'etat' => 'required|max:50',
            ]);

            $plans = new Plan();

            $docs = ['l_tierpay_PF','at_approb_ds','at_approb_if','rpt_IF_PFOPT','f2_PFOPT',
                'model1_PFOPT','rib_PFOPT','f3_PFOPT','at_qualif_PFOPT',
                'eligib_cab_PFOPT','accuse_PFOPT'];
            foreach ($docs as $doc) {
                if ($request->input($doc) !== null) { $plans->$doc = "préparé"; }
                else { $plans->$doc = "non préparé"; }
            }
            $plans->nrc_e = $request->input("nrc_e");
            $plans->annee = $request->input("annee");
            $plans->n_contrat = $request->input("n_contrat");
            //Génerer le Ref pdf
            $rais_abrev = Client::select('clients.rais_abrev')
                ->where('clients.nrc_entrp', $request->input("nrc_e"))
                ->first();
            $plans->refpdf = $rais_abrev['rais_abrev'] . "/" . $plans->annee;

            $plans->dt_contrat_PFOPT = $request->input("dt_contrat_PFOPT");
            $plans->dt_recep_ct = $request->input("dt_recep_ct");
            $plans->dt_accuse_PFOPT = $request->input("dt_accuse_PFOPT");
            $plans->ct_PF = $request->input("ct_PF");
            $plans->etat = $request->input("etat");
            $plans->commentaire = $request->input("commentaire");

            // eviter le doublant de référence pdf
            $count_refpdf_deja = Plan::where('refpdf', $plans->refpdf)->count();
            if ($count_refpdf_deja > 0) {
              $request->session()->flash('error', 'Vous avez déjà saisi un plan avec la même année!');
              return view('plan.add', ['plans' => $plans, 'client' => $client])->with('error');
            }
            $plans->save();

            $request->session()->flash('added', 'Ajouté avec succès');
            return view('plan.add', ['plans' => $plans, 'client' => $client])->with('success');
        }
        else {
            $plans = Plan::all();
            $client = Client::all();

            return view('plan.add', ['plans' => $plans, 'client' => $client]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_plan)
    {
        $plans = Plan::select('clients.raisoci','clients.nrc_entrp', 'plans.*')
                    ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
                    ->where('plans.id_plan', '=', $id_plan)
                    ->first();

      return view('plan.detail',  ['plans' => $plans]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_plan)
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
    public function update(Request $request, $id_plan)
    {
        if ($request -> isMethod('POST')) {

            $plans = Plan::findOrFail($id_plan);

            $request->validate([
                'nrc_e' => 'required|max:15',
                'annee' => 'required|min:4|starts_with:20',
                'n_contrat' => 'nullable|max:15',

                'dt_contrat_PFOPT' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //7
                'dt_accuse_PFOPT' => 'nullable|date|before_or_equal:'.date('Y-m-d'), //7
                'etat' => 'required|max:50',
            ]);

            $docs = ['l_tierpay_PF','at_approb_ds','at_approb_if','rpt_IF_PFOPT','f2_PFOPT',
                'model1_PFOPT','rib_PFOPT','f3_PFOPT','at_qualif_PFOPT',
                'eligib_cab_PFOPT','accuse_PFOPT'];
            foreach ($docs as $doc) {
                if ($request->input($doc) !== null) { $plans->$doc = "préparé"; }
                else { $plans->$doc = "non préparé"; }
            }
            $plans->nrc_e = $request->input("nrc_e");
            $plans->annee = $request->input("annee");
            $plans->n_contrat = $request->input("n_contrat");

            //Génerer le Ref pf
            $rais_abrev = Client::select('clients.rais_abrev')
                ->where('clients.nrc_entrp', $plans->nrc_e)
                ->first();
            $plans->refpdf = $rais_abrev['rais_abrev'] . "/" . $plans->annee;
            $plans->dt_recep_ct = $request->input("dt_recep_ct");
            $plans->dt_contrat_PFOPT = $request->input("dt_contrat_PFOPT");
            $plans->dt_accuse_PFOPT = $request->input("dt_accuse_PFOPT");
            $plans->ct_PF = $request->input("ct_PF");
            $plans->etat = $request->input("etat");
            $plans->commentaire = $request->input("commentaire");

            // si le "plan" est réalisé! mettre à jour l'etat de toutes les "actions formations"
            if (mb_strtolower($plans->etat) === "réalisé") {
              DB::table('plan_formations')
                ->join('plans', 'plan_formations.id_plan', 'plans.id_plan')
                ->where('plan_formations.id_plan', $id_plan)
                ->update(['plan_formations.etat' => "réalisé"]);
            }

            $plans->save();

            $request->session()->flash('updated', 'Modifié avec succès');
            return redirect('/detail-plan/'.$id_plan)->with('success');
        }
        else {
            $plans = Plan::findOrFail($id_plan);
            $client = Client::all();
            return view('plan.edit', ['plans' => $plans, 'client' => $client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_plan)
    {
        $plans = Plan::findOrFail($id_plan);
        $plans->delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/plan');
    }
}
