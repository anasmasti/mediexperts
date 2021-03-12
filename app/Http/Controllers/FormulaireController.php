<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{DemandeFinancement,Client,Cabinet,DemandeRemboursementGiac,Plan,PlanFormation,Formation,Personnel,MissionIntervenant,Giac,Domaine,Theme};
use PDF;
use DB;

class FormulaireController extends Controller
{

    //************* Formulaire 1 *************
    public function print_f1($nrc) {
        $client = Client::findOrFail($nrc);
        return view('_formulaires.f1', ['client' => $client]);
    }

    // ************* Formulaire 2 *************
    public function index_f2() {
        return view('_formulaires.f2');
    }

    //************* Formulaire 3 *************
    public function print_f3($nrc) {
        $cabinet = Cabinet::findOrFail($nrc);
        return view('_formulaires.f3', ['cabinet' => $cabinet]);
    }

    // MODEL 1
    public function print_m1(Request $request) {
      // $client = Client::all();
      return view('_modeles.m1'
      //, ['client' => $client]
      );
    }
    // MODEL 1
    public function print_m3(Request $request) {
      // $client = Client::all();
      return view('_modeles.m3'
      //, ['client' => $client]
      );
    }
    public function FillClients(Request $request) {
      $data = Client::all();
      return response()->json($data);
    }
    public function FillClientPlans(Request $request) {
      $data = Client::select('plan_formations.*', 'themes.nom_theme', 'plans.annee',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss as ncnss_cab', 'clients.raisoci as raisoci', 'plans.annee')
        ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('plan_formations', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->where('clients.nrc_entrp', $request->nrcEntrp)
        ->orderBy('plan_formations.n_action')
        ->get();
      return response()->json($data);
    }
    public function FillDatesPlan(Request $request) {
      $data = PlanFormation::select('formations.n_form', 'formations.date1','formations.date2','formations.date3','formations.date4','formations.date5',
      'formations.date6','formations.date7','formations.date8','formations.date9','formations.date10',
      'formations.date11','formations.date12','formations.date13','formations.date14','formations.date15',
      'formations.date16','formations.date17','formations.date18','formations.date19','formations.date20',
      'formations.date21','formations.date22','formations.date23','formations.date24','formations.date25',
      'formations.date26','formations.date27','formations.date28','formations.date29','formations.date30')
        ->join('formations', 'plan_formations.n_form', 'formations.n_form')
        ->where('formations.n_form', $request->nForm)
        ->orderBy('plan_formations.dt_debut', 'asc')
        ->orderBy('plan_formations.created_at', 'asc')
        ->get();
      return response()->json($data);
    }
    public function FillDatesForm(Request $request) {
      $data = Formation::findOrFail($request->idForm);
      return response()->json($data);
    }

    //MODELE 4
    public function print_m4($idform) {
      $id_theme = Theme::select('themes.id_theme')
        ->join('plan_formations', 'themes.id_theme', 'plan_formations.id_thm')
        ->join('formations', 'formations.n_form', 'plan_formations.n_form')
        ->where('formations.id_form', $idform)
        ->first();
      $formation = Formation::select('clients.raisoci', 'clients.ice', 'themes.nom_theme','plan_formations.*', 'formations.*')
          ->join('plan_formations', 'plan_formations.n_form', 'formations.n_form')
          ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
          ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
          ->join('themes', 'themes.id_theme', 'plan_formations.id_thm')
          ->where([['formations.id_form', $idform], ['themes.id_theme', $id_theme["id_theme"]]])
          ->first();
      // $bdg_letter = \App\Helper\Helper::NumberToLetter(($formation["bdg_total"] * .2 + $formation["bdg_total"]));

      return view('_modeles.m4', ['formation' => $formation/*, 'bdg_letter' => $bdg_letter*/]);
    }

    //FORMULAIRE 4
    public function print_f4(Request $request) {
      $plans = Plan::select('plans.*', 'clients.raisoci', 'clients.rais_abrev')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->get();
      return view('_formulaires.f4', ['plans' => $plans]);
    }
    public function FillFormationF4(Request $request) {
      $data = Formation::select('formations.*', 'themes.nom_theme', 'clients.raisoci', 'clients.ville', 'clients.local_2')
        ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->where('plan_formations.n_form', $request->nForm)
        ->get();
      return response()->json($data);
    }
    public function FillPersonnelF4(Request $request) {
      $data = Formation::select('personnels.*', 'formations.*')
        ->join('formation_personnels', 'formations.id_form', 'formation_personnels.id_form')
        ->join('personnels', 'formation_personnels.cin', 'personnels.cin')
        ->where('formations.id_form', $request->idForm)
        ->get();
      return response()->json($data);
    }
    public function FillPersonInfoF4(Request $request) {
      $data = Personnel::select('personnels.*', 'plans.annee')
        ->where('personnels.cin', $request->cin)
        ->first();
      return response()->json($data);
    }
    // END FORMULAIRE

    //MODELE 5
    public function print_m5() {
        $client = Client::all();

      return view('_modeles.m5', ['client' => $client]);
    }

    //FORMULAIRE 2
    public function print_f2() {
      $plans = Plan::select('plans.*', 'clients.raisoci', 'clients.rais_abrev')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->get();
      return view('_formulaires.f2', ['plans' => $plans]);
    }
    public function FillActionFormation(Request $request) {
      $data = PlanFormation::select('plan_formations.*', 'themes.nom_theme as nom_theme', 'domaines.nom_domain', 'clients.raisoci' , 'plans.annee')
        ->join('plans', 'plans.id_plan', 'plan_formations.id_plan')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->join('formations', 'plan_formations.n_form', 'formations.n_form')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->where('plans.id_plan', $request->idPlan)
        ->get();
      return response()->json($data);
    }
    public function FillFormationF2(Request $request) {
      $id_theme = Theme::select('themes.id_theme')
        ->join('plan_formations', 'themes.id_theme', 'plan_formations.id_thm')
        ->where('plan_formations.n_form', $request->nForm)
        ->first();

      $id_domain = Domaine::select('domaines.id_domain')
      ->join('plan_formations', 'domaines.id_domain', 'plan_formations.id_dom')
      ->where('plan_formations.n_form', $request->nForm)
      ->first();

      $data = Formation::select('formations.*', 'domaines.*', 'themes.*', 'clients.raisoci', 'clients.raisoci',
        'plan_formations.*', 'plans.*',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss' , 'plans.annee')
        ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
        ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('themes', 'themes.id_theme', 'plan_formations.id_thm')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->where([['plan_formations.n_Form', $request->nForm], ['themes.id_theme', $id_theme["id_theme"]],
          ['domaines.id_domain', $id_domain["id_domain"]]])
        ->get();
      return response()->json($data);
    }

    //PLAN FORMATION
    public function print_pf(Request $request) {
      // $client = Client::all();
      return view('_formulaires.plans'/*, ['client' => $client]*/);
    }

    public function FillReferencesPlan(Request $request) {
      $data = Plan::select('plans.*', 'clients.*' , 'plans.annee')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->where('plans.nrc_e', $request->nrcEntrp)
        ->get();

      return response()->json($data);
    }
    public function FillPlansByReference(Request $request) {
      $data = Client::select('plan_formations.*', 'themes.nom_theme','domaines.nom_domain','plans.*',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss as ncnss_cab', 'plans.annee')
        ->join('plans', 'clients.nrc_entrp', 'plans.nrc_e')
        ->join('plan_formations', 'plans.id_plan', 'plan_formations.id_plan')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->where('plans.id_plan', $request->idPlan)
        // ->orderBy('plan_formations.dt_debut')
        ->orderBy('plan_formations.n_form', 'asc')
        ->get();
      return response()->json($data);
    }
    public function print_avis_aff(Request $request) {
      $client = Client::all();
      return view('_formulaires.avis-affichage', ['client' => $client]);
    }

    // MODELE 6
    public function print_m6(Request $request) {
      $client = Client::all();
      $cabinet = Cabinet::all();
      return view('_modeles.m6', ['client' => $client, 'cabinet' => $cabinet]);
    }
    public function FillPlanTheme(Request $request) {
      $data = Client::select('plan_formations.*', 'themes.nom_theme', 'clients.*', 'plans.annee')
        ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('plan_formations', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->where([['plans.id_plan', $request->idPlan], ['plan_formations.etat', "réalisé"]])
        ->orWhere([['plans.id_plan', $request->idPlan], ['plan_formations.etat', "planifié"]])
        ->get();
      return response()->json($data);
    }
    public function FillCabinet(Request $request) {
      $data = Cabinet::find($request->nrcCab);
      return response()->json($data);
    }

    // FICHE D'ÉVALUATION
    public function print_fiche_evaluation(Request $request) {
        $client = Client::all();
      return view('_formulaires.fiche-eval', ['client' => $client]);
    }
    public function FillFicheEval(Request $request) {
      $data = PlanFormation::select('formations.*', 'plan_formations.lieu', 'themes.nom_theme',
       'clients.raisoci', 'clients.ville','clients.local_2', 'intervenants.nom as nom_interv',
        'intervenants.prenom as prenom_interv', 'cabinets.raisoci as raisoci_cab','plans.annee')
        ->join('formations', 'formations.n_form', 'plan_formations.n_form')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->where('plan_formations.n_form', $request->nForm)
        ->get();
    return response()->json($data);
    }

    public function print_att_reference_plan() {
      return view('_formulaires.att-reference-plan');
    }

    public function FillCabinetInfo(Request $request) {
      $data = Cabinet::select('cabinets.*')
        ->where('cabinets.raisoci', 'LIKE', $request->raisociCab)
        ->first();
      return response()->json($data);
    }

    public function FillPlansByClient(Request $request)
    {
      $data = Plan::select('plans.*')
      ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
      ->where('clients.nrc_entrp', $request->nrc)->get();
      return response()->json($data);
    }






}
