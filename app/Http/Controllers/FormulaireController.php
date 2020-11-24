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
      $client = Client::all();
      return view('_modeles.m1', ['client' => $client]);
    }
    public function FillClientPlans(Request $request) {
      $data = Client::select('plan_formations.*', 'themes.nom_theme', 'plans.annee',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss as ncnss_cab', 'clients.raisoci as raisoci')
        // ->join('plan_formations', 'clients.nrc_entrp', 'plan_formations.nrc_e')
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
      $data = PlanFormation::select('formations.date1','formations.date2','formations.date3','formations.date4','formations.date5',
      'formations.date6','formations.date7','formations.date8','formations.date9','formations.date10',
      'formations.date11','formations.date12','formations.date13','formations.date14','formations.date15',
      'formations.date16','formations.date17','formations.date18','formations.date19','formations.date20',
      'formations.date21','formations.date22','formations.date23','formations.date24','formations.date25',
      'formations.date26','formations.date27','formations.date28','formations.date29','formations.date30')
        ->join('formations', 'plan_formations.n_form', 'formations.n_form')
        ->where('formations.n_form', $request->nForm)
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
          // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
          ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
          ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
          ->join('themes', 'themes.id_theme', 'plan_formations.id_thm')
          ->where([['formations.id_form', $idform], ['themes.id_theme', $id_theme["id_theme"]]])
          ->first();

      return view('_modeles.m4', ['formation' => $formation]);
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
        // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
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
      $data = Personnel::select('personnels.*')
        ->where('personnels.cin', $request->cin)
        ->first();
      return response()->json($data);
    }
    // END FORMULAIRE

    //MODELE 5
    public function print_m5() {
        $plans = Plan::select('plans.*', 'clients.raisoci', 'clients.rais_abrev')
          ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
          ->get();
      return view('_modeles.m5', ['plans' => $plans]);
    }

    //FORMULAIRE 2
    public function print_f2() {
    //   $plan = PlanFormation::select('plan_formations.*', 'themes.nom_theme as nom_theme',
    //     'domaines.nom_domain', 'clients.nrc_entrp', 'clients.raisoci')
    //     ->join('formations', 'plan_formations.n_form', 'formations.n_form')
    //     ->join('plans', 'plans.id_plan', 'plan_formations.id_plan')
    //     ->join('Clients', 'clients.nrc_entrp', 'plans.nrc_e')
    //     ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
    //     ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
    //     ->get();
      $plans = Plan::select('plans.*', 'clients.raisoci', 'clients.rais_abrev')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->get();
      return view('_formulaires.f2', ['plans' => $plans]);
    }
    public function FillActionFormation(Request $request) {
      $data = PlanFormation::select('plan_formations.*', 'themes.nom_theme as nom_theme', 'domaines.nom_domain', 'clients.raisoci')
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
      // $data = Formation::select('formations.*', 'themes.nom_theme', 'clients.raisoci')
      //   ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
      //   ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
      //   ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
      //   ->where('plan_formations.n_form', $request->nForm)
      //   ->get();

      $id_theme = Theme::select('themes.id_theme')
        ->join('plan_formations', 'themes.id_theme', 'plan_formations.id_thm')
        ->where('plan_formations.n_form', $request->nForm)
        ->first();

      $id_domain = Domaine::select('domaines.id_domain')
      ->join('plan_formations', 'domaines.id_domain', 'plan_formations.id_dom')
      ->where('plan_formations.n_form', $request->nForm)
      ->first();

      $data = Formation::select('formations.*', 'domaines.*', 'themes.*', 'clients.raisoci', 'clients.raisoci',
        'plan_formations.*',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss')
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
    // public function FillFormationInfo(Request $request) {
    //   $data = Formation::select('formations.*', 'themes.*', 'domaines.nom_domain', 'clients.raisoci',
    //     'plan_formations.lieu', 'plan_formations.type_form', 'plan_formations.bdg_total',
    //     'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss')
    //     ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
    //     ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
    //     ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
    //     ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
    //     ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
    //     ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
    //     ->where('plan_formations.n_Form', $request->nForm)
    //     ->first();
    //   return response()->json($data);
    // }

    //PLAN FORMATION
    public function print_pf(Request $request) {
      $client = Client::all();
      return view('_formulaires.plans', ['client' => $client]);
    }

    public function FillReferencesPlan(Request $request) {
      $data = Plan::select('plans.*', 'clients.raisoci')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->where('plans.nrc_e', $request->nrcEntrp)
        ->get();

      return response()->json($data);
    }
    public function FillPlansByReference(Request $request) {
      $data = Client::select('plan_formations.*', 'themes.nom_theme','domaines.nom_domain','plans.*',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss as ncnss_cab')
        // ->join('plan_formations', 'clients.nrc_entrp', 'plan_formations.nrc_e')
        ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('plan_formations', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->where('plans.id_plan', $request->idPlan)
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
      $data = Client::select('plan_formations.*', 'themes.nom_theme', 'clients.*','plans.annee')
        // ->join('plan_formations', 'clients.nrc_entrp', 'plan_formations.nrc_e')
        ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('plan_formations', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        // ->where('plan_formations.etat', "réalisé")
        ->where('clients.nrc_entrp', $request->nrcEntrp)
        ->get();
      return response()->json($data);
    }
    public function FillCabinet(Request $request) {
      $data = Cabinet::find($request->nrcCab);
      return response()->json($data);
    }

    // FICHE D'ÉVALUATION
    public function print_fiche_evaluation(Request $request) {
        $plans = Plan::select('plans.*', 'clients.raisoci', 'clients.rais_abrev')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->get();
      return view('_formulaires.fiche-eval', ['plans' => $plans]);
    }
    public function FillFicheEval(Request $request) {
      $data = PlanFormation::select('formations.*', 'plan_formations.lieu', 'themes.nom_theme',
       'clients.raisoci', 'clients.ville','clients.local_2', 'intervenants.nom as nom_interv', 'intervenants.prenom as prenom_interv',
       'cabinets.raisoci as raisoci_cab')
        ->join('formations', 'formations.n_form', 'plan_formations.n_form')
        // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->where('plan_formations.n_form', $request->nForm)
        ->get();
    return response()->json($data);
    }























    // public function download_f3($nrc) {
    //     $cabinet = Cabinet::findOrFail($nrc);
    //     $f3_pdf = PDF::loadView('_formulaires.f3', ['cabinet' => $cabinet]);
    //     return $f3_pdf->stream('f3.pdf');
    // }
}
