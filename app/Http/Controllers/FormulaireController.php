<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{DemandeFinancement,Client,Cabinet,DemandeRemboursementGiac,Plan,ActionFormation,Formation,Personnel,MissionIntervenant,Giac,Domaine,Theme};
use Illuminate\Foundation\Console\Presets\React;
//use Knp\Snappy\Pdf;
use Illuminate\Support\Facades\DB;
use PDF;

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
    public function _G6 (Request $request) {

      return view('_formulaires.G6');

    }
    public function FillClients(Request $request) {
      $data = Client::all();
      return response()->json($data);
    }
    public function FillClientPlans(Request $request) {
      $data = Client::select('action_formations.*', 'themes.nom_theme', 'plans.annee',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss as ncnss_cab', 'clients.raisoci as raisoci', 'plans.annee')
        ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('action_formations', 'plans.id_plan', '=', 'action_formations.id_plan')
        ->join('themes', 'action_formations.id_thm', 'themes.id_theme')
        ->join('intervenants', 'action_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->where('clients.nrc_entrp', $request->nrcEntrp)
        ->orderBy('action_formations.n_action')
        ->get();
      return response()->json($data);
    }
    public function FillDatesPlan(Request $request) {
      $data = ActionFormation::select('formations.n_form', 'formations.date1','formations.date2','formations.date3','formations.date4','formations.date5',
      'formations.date6','formations.date7','formations.date8','formations.date9','formations.date10',
      'formations.date11','formations.date12','formations.date13','formations.date14','formations.date15',
      'formations.date16','formations.date17','formations.date18','formations.date19','formations.date20',
      'formations.date21','formations.date22','formations.date23','formations.date24','formations.date25',
      'formations.date26','formations.date27','formations.date28','formations.date29','formations.date30', 'plans_formations.nb_partcp_total' , 'plans_formations.organisme')
        ->join('formations', 'action_formations.n_form', 'formations.n_form')
        ->where('formations.n_form', $request->nForm)
        ->orderBy('action_formations.dt_debut', 'asc')
        ->orderBy('action_formations.created_at', 'asc')
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
        ->join('action_formations', 'themes.id_theme', 'action_formations.id_thm')
        ->join('formations', 'formations.n_form', 'action_formations.n_form')
        ->where('formations.id_form', $idform)
        ->first();
      $formation = Formation::select('clients.raisoci', 'clients.ice', 'themes.nom_theme','action_formations.*', 'formations.*')
          ->join('action_formations', 'action_formations.n_form', 'formations.n_form')
          ->join('plans', 'plans.id_plan', '=', 'action_formations.id_plan')
          ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
          ->join('themes', 'themes.id_theme', 'action_formations.id_thm')
          ->where([['formations.id_form', $idform], ['themes.id_theme', $id_theme["id_theme"]]])
          ->first();
      // $bdg_letter = \App\Helper\Helper::NumberToLetter(($formation["bdg_total"] * .2 + $formation["bdg_total"]));

      return view('_modeles.m4', ['formation' => $formation/*, 'bdg_letter' => $bdg_letter*/]);
    }

    //FORMULAIRE 4
    public function print_f4(Request $request) {
      $clients = Client::all();

      return view('_formulaires.f4', ['clients' => $clients]);
    }

    public function FillFormationF4(Request $request) {
      $data = Formation::select('formations.*', 'themes.nom_theme', 'clients.raisoci', 'clients.ville', 'clients.local_2')
        ->join('action_formations', 'formations.n_form', 'action_formations.n_form')
        ->join('plans', 'plans.id_plan', '=', 'action_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('themes', 'action_formations.id_thm', 'themes.id_theme')
        ->where('action_formations.n_form', $request->nForm)
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
        $client = Client::all();

      return view('_modeles.m5', ['client' => $client]);
    }

    //FORMULAIRE 2
      public function print_f2() {
        $clients = Client::all();

      return view('_formulaires.f2', ['clients' => $clients]);
    }

    public function FillActionFormation(Request $request) {
      $data = ActionFormation::select('action_formations.*', 'themes.nom_theme as nom_theme', 'domaines.nom_domain', 'clients.raisoci' , 'plans.annee')
        ->join('plans', 'plans.id_plan', 'action_formations.id_plan')
        ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
        ->join('formations', 'action_formations.n_form', 'formations.n_form')
        ->join('themes', 'action_formations.id_thm', 'themes.id_theme')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->where('plans.id_plan', $request->idPlan)
        ->get();
      return response()->json($data);
    }
    public function FillFormationF2(Request $request) {
      $id_theme = Theme::select('themes.id_theme')
        ->join('action_formations', 'themes.id_theme', 'action_formations.id_thm')
        ->where('action_formations.n_form', $request->nForm)
        ->first();

      $id_domain = Domaine::select('domaines.id_domain')
      ->join('action_formations', 'domaines.id_domain', 'action_formations.id_dom')
      ->where('action_formations.n_form', $request->nForm)
      ->first();

      $data = Formation::select('formations.*', 'domaines.*', 'themes.*', 'clients.raisoci', 'clients.raisoci',
        'action_formations.*', 'plans.*',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss' , 'plans.annee')
        ->join('action_formations', 'formations.n_form', 'action_formations.n_form')
        ->join('intervenants', 'action_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        //*->join('clients', 'action_formations.nrc_e', 'clients.nrc_entrp')
        ->join('plans', 'plans.id_plan', '=', 'action_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('themes', 'themes.id_theme', 'action_formations.id_thm')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->where([['action_formations.n_Form', $request->nForm], ['themes.id_theme', $id_theme["id_theme"]],
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
      $data = Client::select('action_formations.*', 'themes.nom_theme','domaines.nom_domain','plans.*',
        'cabinets.raisoci as raisoci_cab', 'cabinets.ncnss as ncnss_cab', 'plans.annee')
        ->join('plans', 'clients.nrc_entrp', 'plans.nrc_e')
        ->join('action_formations', 'plans.id_plan', 'action_formations.id_plan')
        ->join('themes', 'action_formations.id_thm', 'themes.id_theme')
        ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
        ->join('intervenants', 'action_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->where('plans.id_plan', $request->idPlan)
        // ->orderBy('action_formations.dt_debut')
        ->orderBy('action_formations.n_form', 'asc')
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
      $data = Client::select('action_formations.*', 'themes.nom_theme', 'clients.*', 'plans.annee')
        ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('action_formations', 'plans.id_plan', '=', 'action_formations.id_plan')
        ->join('themes', 'action_formations.id_thm', 'themes.id_theme')
        ->where([['plans.id_plan', $request->idPlan], ['action_formations.etat', "réalisé"]])
        ->orWhere([['plans.id_plan', $request->idPlan], ['action_formations.etat', "modifié"]])
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
      $data = ActionFormation::select('formations.*', 'action_formations.lieu', 'themes.nom_theme',
       'clients.raisoci', 'clients.ville','clients.local_2', 'intervenants.nom as nom_interv',
        'intervenants.prenom as prenom_interv', 'cabinets.raisoci as raisoci_cab','plans.annee')
        ->join('formations', 'formations.n_form', 'action_formations.n_form')
        ->join('plans', 'plans.id_plan', '=', 'action_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('intervenants', 'action_formations.id_inv', 'intervenants.id_interv')
        ->join('cabinets', 'intervenants.nrc_c', 'cabinets.nrc_cab')
        ->join('themes', 'action_formations.id_thm', 'themes.id_theme')
        ->where('action_formations.n_form', $request->nForm)
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
      $data = Plan::select('plans.*','clients.raisoci')
      ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
      ->where('clients.nrc_entrp', $request->nrc)->get();
      return response()->json($data);
    }

    public function FillAllCabinets(Request $request)
    {
      $data=Cabinet::all();
      return response()->json($data);
    }






}
