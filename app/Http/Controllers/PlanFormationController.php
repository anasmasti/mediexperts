<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{PlanFormation,Plan,Formation,Intervenant,Client,Domaine,Theme,Cabinet};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

// Action De Formation //
class PlanFormationController extends Controller
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

        $plan = PlanFormation::all();
        $client = Client::all();
        $interv = Intervenant::all();
        $theme = Theme::all();
        $domain = Domaine::all();

        return view('planformation.view', [
            'plan' => $plan,
            'client' => $client,
            'interv' => $interv,
            'theme' => $theme
        ]);
    }
    public function searchplan(Request $request)
    {   $search_input = $request->input ( 'search_input' );
        $plan = Plan::select('plan_formations.*')
            ->join('plan_formations', 'plan_formations.id_plan', 'plans.id_plan')
            ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
            ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
            ->where('plans.refpdf', 'LIKE', '%'. $search_input . '%')
            ->orWhere('themes.nom_theme', 'LIKE', '%'. $search_input . '%')
            ->orWhere('plan_formations.dt_debut', 'LIKE', '%'. $search_input . '%')
            ->orWhere('plan_formations.dt_fin', 'LIKE', '%'. $search_input . '%')
            ->orWhere('intervenants.nom', 'LIKE', '%'. $search_input . '%')
            ->orWhere('intervenants.prenom', 'LIKE', '%'. $search_input . '%')
            ->get();
        //get client
        $client = Client::all();
        $interv = Intervenant::all();
        return view('planformation.view', ['plan'=>$plan, 'client'=>$client, 'interv'=>$interv]);
    }

    public function ActionFormationClient(Request $request)
    {
        $plan = PlanFormation::select('plan_formations.*')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->where([['clients.nrc_entrp', '=', $request->nrc], ['plans.annee', '=', $request->annee]])
        ->get();

        return view('planformation.view', ['plan' => $plan]);
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

    //******************************************************** */
    public function FindClientPlan(Request $request) {
        $data = Plan::select('clients.nrc_entrp', 'clients.raisoci')
                ->join('clients', 'plans.nrc_e', 'clients.nrc_entrp')
                ->where('plans.id_plan', $request->idPlan)
                ->first();
        return response()->json($data);
    }
    //find ville of client when selecting the client
    public function FindDomainDependVilleClient(Request $request) {
        $ville = Client::findOrFail($request->nrc)->ville;
        $data = Domaine::select('id_domain', 'nom_domain')
                ->where('domaines.ville', $ville)
                ->get();
        $client = Client::select('clients.nom_resp', 'clients.raisoci')
                ->where('clients.nrc_entrp', $request->nrc)
                ->first();
        return response()->json(['data' => $data, 'client' => $client]);
    }

    //find theme of domain when selecting the domain
    public function FindThemesDomain(Request $request) {
        $data = Theme::select('Themes.id_theme', 'Themes.nom_theme', 'domaines.cout')
                ->join('Domaines', 'Themes.id_dom', '=', 'Domaines.id_domain')
                ->where('Domaines.id_domain', $request->idDomain)
                ->get();
        return response()->json($data);
    }

    //find organisme of intervenant when selecting the intervenant
    public function FindOrganismeInterv(Request $request) {
        $data = Cabinet::select('nrc_cab', 'raisoci')
                ->join('intervenants', 'cabinets.nrc_cab', '=', 'intervenants.nrc_c')
                ->where('intervenants.id_interv', $request->idInv)
                ->get();
        // $data = "select cabinets.nrc_cab, cabinets.raisoci from cabinets INNER join intervenants on (intervenants.nrc_c = cabinets.nrc_cab)"
        //         ."where intervenants.id_interv = ".$request->idInv;
        return response()->json($data);
    }
    //******************************************************** */


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
            $cabinet = Cabinet::all();
            $interv = Intervenant::all();
            $domain = Domaine::all();
            $theme = Theme::all();
            $plans = Plan::all();

            $request->validate([
                // 'n_form' => 'required|unique:plan_formations|max:15',
                // 'refpdf' => 'required|unique:plan_formations|max:15',
                'id_plan' => 'required|max:15',
                'id_inv' => 'required|max:15',
                'id_dom' => 'required|max:15',
                'id_thm' => 'required|max:300',
                'dt_debut' => 'required|date|before_or_equal:dt_fin',
                'dt_fin' => 'required|date',
                'nb_jour' => 'required|max:3',
                'nb_heure' => 'required|max:4',
                'type_form' => 'required|max:50',
                'organisme' => 'required|max:50',
                'lieu' => 'required|max:100',
                'nom_resp' => 'required|max:50',
                'nb_grp' => 'required|max:3',
                'nb_partcp_total' => 'required|max:3',
                'nb_cadre' => 'required|max:3',
                'nb_employe' => 'required|max:3',
                'nb_ouvrier' => 'required|max:3',
                'bdg_total' => 'required|max:12',
                'bdg_jour' => 'required|max:12',
                'etat' => 'required',
            ]);

            $plan = new PlanFormation();

            //find nom_theme
            $nom_theme = Theme::find($request->input("id_thm"))->nom_theme;

            // $plan->n_form = $request->input("n_form");
            // $plan->refpdf = $request->input("refpdf");

            // Génerer numèro d'action
            $last_n_action = Plan::select('plan_formations.*')
                            ->join('plan_formations', 'plan_formations.id_plan', 'plans.id_plan')
                            ->where('plan_formations.id_plan', $request->input("id_plan"))
                            ->count();

            $plan->n_action = "TF".($last_n_action + 1);

            //// chercher si l'intervenant est occupé dans les dates précisés
            // $actionformation = PlanFormation::where('id_plan', $request->input("id_plan"))->get();
            // for ($i=0; $i < count($actionformation); $i++) {
            //     if ($request->input("dt_debut") >= $actionformation[$i]['dt_debut'] &&
            //         $request->input("dt_debut") <= $actionformation[$i]['dt_fin'] ||
            //         $request->input("dt_fin") >= $actionformation[$i]['dt_debut'] &&
            //         $request->input("dt_fin") <= $actionformation[$i]['dt_fin'] &&
            //         $request->input("id_inv") == $actionformation[$i]['id_inv']) {
            //           error_log("action date debut : ".$actionformation[$i]['dt_debut']);
            //           error_log("input date debut : ".$request->input("dt_debut"));
            //           $request->session()->flash('error', 'L\'intervenant sélectionné est occupé dans les dates choisi!');
            //           return back();
            //     }
            // }
            $plan->id_inv = $request->input("id_inv");

            $plan->id_plan = $request->input("id_plan");
            $plan->id_thm = $request->input("id_thm");
            $plan->id_dom = $request->input("id_dom");
            // $plan->dt_debut = \Carbon\Carbon::parse($request->input("dt_debut"))->format('Y-m-d H:i:s');
            // $plan->dt_fin = \Carbon\Carbon::parse($request->input("dt_fin"))->format('Y-m-d H:i:s');
            $plan->dt_debut = $request->input("dt_debut");
            $plan->dt_fin = $request->input("dt_fin");
            $plan->nb_jour = $request->input("nb_jour");
            $plan->nb_heure = $request->input("nb_heure");
            $plan->type_form = $request->input("type_form");
            $plan->organisme = $request->input("organisme");
            $plan->lieu = $request->input("lieu");
            $plan->nom_resp = $request->input("nom_resp");
            $plan->nb_grp = $request->input("nb_grp");
            $plan->nb_partcp_total = $request->input("nb_partcp_total");
            $plan->nb_cadre = $request->input("nb_cadre");
            $plan->nb_employe = $request->input("nb_employe");
            $plan->nb_ouvrier = $request->input("nb_ouvrier");
            $plan->bdg_total = $request->input("bdg_total");
            $plan->bdg_jour = $request->input("bdg_jour");
            $plan->bdg_letter = $request->input("bdg_letter");
            $plan->commentaire = $request->input("commentaire");
            $plan->etat = $request->input("etat");

            $docs = ['model5', 'model3', 'f4', 'fiche_eval',
                    'support_form', 'cv_inv', 'avis_affich'];
            foreach ($docs as $doc) {
                if ($request->input($doc) != null) {
                    $plan->$doc = $request->input($doc);
<<<<<<< HEAD
                    // $plan->$doc = "préparé";
=======
                    //$plan->$doc = "préparé";
>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
                }
                else {
                    $plan->$doc = "non préparé";
                }
            }

            $plan->save();

            //*** UPDATE INTERVENANT ***/
            // if ($request->input("etat") != "annulé" && $request->input("etat") != "réalisé") {
                // $interv = Intervenant::findOrFail($request->input("id_inv"));
                // $inv_occupé = PlanFormation::select('plan_formations.*')
                //     ->join('intervenants', 'plan_formations.id_inv', 'intervenants.id_interv')
                //     ->whereRaw('plan_formations.id_inv = '.$request->input("id_inv"),
                //         'plan_formations.dt_debut < '.$request->input("dt_debut"),
                //         'plan_formations.dt_debut > '.$request->input("dt_fin"),
                //         'plan_formations.dt_fin < '.$request->input("dt_debut"),
                //         'plan_formations.dt_fin > '.$request->input("dt_fin")
                //     )->count();
                // if ($inv_occupé == 1) {
                    // $interv->etat = "occupé 2 actions";
                    // $interv->module = $nom_theme;
                    // $interv->save();
                // } else {
                    // $request->session()->flash('error', 'L\'intervenant'.$interv->nom.' est occupé dans les dates sélectionnés !');
                    // return redirect('/add-pf');
                // }
            // }

            $request->session()->flash('added', 'Ajouté avec succès');
            return view('planformation.add', [
                    'plan' => $plan, 'plans' => $plans,
                    'client' => $client, 'cabinet' => $cabinet,
                    'interv' => $interv, 'domain' => $domain,
                    'theme' => $theme])->with('success');
        }
        else {
            $plan = PlanFormation::all();
            $client = Client::all();
            $cabinet = Cabinet::all();
            $interv = Intervenant::all();
            $domain = Domaine::all();
            $theme = Theme::all();
            $plans = Plan::all();

            return view('planformation.add', [
                'plan' => $plan, 'plans' => $plans,
                'client' => $client, 'cabinet' => $cabinet,
                'interv' => $interv, 'domain' => $domain,
                'theme' => $theme]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
=======
    // afficher en details
>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
    public function show(Request $request, $nform)
    {
        $plan = PlanFormation::findOrFail($nform);

<<<<<<< HEAD
        // $client = Client::all();
        // $interv = Intervenant::all();
        // $domain = Domaine::all();
        // $theme = Theme::all();
        // $cabinet = Cabinet::all();

=======
>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
        $plan_props = Client::select('clients.raisoci','clients.nrc_entrp','intervenants.nom','intervenants.prenom', 'plans.refpdf')
                    ->join('plans', 'clients.nrc_entrp', '=', 'plans.nrc_e')
                    ->join('plan_formations', 'plans.id_plan', '=', 'plan_formations.id_plan')
                    ->join('intervenants', 'intervenants.id_interv', '=', 'plan_formations.id_inv')
                    ->where('plan_formations.n_form', '=', $nform)
                    ->first();
        $module_props = PlanFormation::select('domaines.nom_domain', 'themes.nom_theme')
                    ->join('themes', 'themes.id_theme', '=', 'plan_formations.id_thm')
                    ->join('domaines', 'domaines.id_domain', '=', 'themes.id_dom')
                    ->where('plan_formations.n_form', '=' , $nform)
                    ->first();

      return view('planformation.detail',  ['plan_props' => $plan_props, 'plan' => $plan, 'module_props' => $module_props]);
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
    public function update(Request $request, $nform)
    {
        if ($request -> isMethod('POST')) {

            $plan = PlanFormation::findOrFail($nform);

            //get data from
            $client = Client::all();
            $cabinet = Cabinet::all();
            $interv = Intervenant::all();
            $domain = Domaine::all();
            $theme = Theme::all();

            $request->validate([
                // 'refpdf' => 'required|max:50|unique:plan_formations,refpdf,'.$plan->n_form.',n_form',
                'id_plan' => 'required|max:15',
                'id_inv' => 'required|max:15',
                'id_dom' => 'required|max:15',
                'id_thm' => 'required|max:300',
                'dt_debut' => 'required|date|before_or_equal:dt_fin',
                'dt_fin' => 'required|date',
                'nb_jour' => 'required|max:3',
                'nb_heure' => 'required|max:4',
                'type_form' => 'required|max:50',
                'organisme' => 'required|max:50',
                'lieu' => 'required|max:100',
                'nom_resp' => 'required|max:50',
                'nb_grp' => 'required|max:3',
                'nb_partcp_total' => 'required|max:3',
                'nb_cadre' => 'required|max:3',
                'nb_employe' => 'required|max:3',
                'nb_ouvrier' => 'required|max:3',
                'bdg_total' => 'required|max:12',
                'bdg_jour' => 'required|max:12',
                'etat' => 'required',
            ]);

            // $plan->n_form = $request->input("n_form");
            //find nom_theme
            $nom_theme = Theme::find($request->input("id_thm"))->nom_theme;

            //// chercher si l'intervenant est occupé dans les dates précisés
            // $actionformation = PlanFormation::where('id_plan', $request->input("id_plan"))->get();
            // for ($i=0; $i < count($actionformation); $i++) {
            //     if ($request->input("dt_debut") >= $actionformation[$i]['dt_debut'] &&
            //         $request->input("dt_debut") <= $actionformation[$i]['dt_fin'] ||
            //         $request->input("dt_fin") >= $actionformation[$i]['dt_debut'] &&
            //         $request->input("dt_fin") <= $actionformation[$i]['dt_fin']) {

            //             if ($request->input("id_inv") == $actionformation[$i]['id_inv'] && $plan->n_form != $actionformation[$i]['n_form']) {
            //                 $request->session()->flash('error', 'L\'intervenant sélectionné est occupé dans les dates choisi!');
            //                 return back();
            //             }
            //     }
            // }
            $plan->id_inv = $request->input("id_inv");

            $plan->id_plan = $request->input("id_plan");
            $plan->id_thm = $request->input("id_thm");
            $plan->id_dom = $request->input("id_dom");
            $plan->dt_debut = $request->input("dt_debut");
            $plan->dt_fin = $request->input("dt_fin");
            $old_nb_jour = $plan->nb_jour;
            $plan->nb_jour = $request->input("nb_jour");
            $plan->nb_heure = $request->input("nb_heure");
            $plan->type_form = $request->input("type_form");
            $plan->organisme = $request->input("organisme");
            $plan->lieu = $request->input("lieu");
            $plan->nom_resp = $request->input("nom_resp");
            $plan->nb_grp = $request->input("nb_grp");
            $plan->nb_partcp_total = $request->input("nb_partcp_total");
            $plan->nb_cadre = $request->input("nb_cadre");
            $plan->nb_employe = $request->input("nb_employe");
            $plan->nb_ouvrier = $request->input("nb_ouvrier");
            $plan->bdg_total = $request->input("bdg_total");
            $plan->bdg_jour = $request->input("bdg_jour");
            $plan->bdg_letter = $request->input("bdg_letter");
            $plan->commentaire = $request->input("commentaire");
            $plan->etat = $request->input('etat');


            $docs = ['model5', 'model3', 'f4', 'fiche_eval',
                    'support_form', 'cv_inv', 'avis_affich'];
<<<<<<< HEAD
=======

>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
            foreach ($docs as $doc) {
                if ($request->input($doc) != null) { $plan->$doc = "préparé"; }
                else { $plan->$doc = "non préparé"; }
            }

            $dates =
            [
              'date1', 'date2', 'date3', 'date4', 'date5',
              'date6', 'date7', 'date8', 'date9', 'date10',
              'date11', 'date12', 'date13', 'date14', 'date15',
              'date16', 'date17', 'date18', 'date19', 'date20',
              'date21', 'date22', 'date23', 'date24', 'date25',
              'date26', 'date27', 'date28', 'date29', 'date30'
            ];
            // gérer les dates des formation relatives au action
            $cur_nb_jour = $request->input("nb_jour");
            if ($old_nb_jour > $cur_nb_jour) {
              // supprimer les dates saisis après le nombre de jours
              // +(ex: nb jour == 3, supprimer date4,5,6.. dans 'Formations')
              for ($i=$cur_nb_jour; $i < count($dates) ; $i++) {
                $cur_date = 'formations.'.$dates[$i];
                DB::table('formations')
                ->join('plan_formations', 'plan_formations.n_form', 'formations.n_form')
                ->where('plan_formations.n_form', $plan->n_form)
                ->update([$cur_date => null]); //retirer la valeur de date
              }
              $request->session()->flash('info', 'Des dates sont supprimés lors de la diminution de nombre de jours de "plan formation"');
            }
            else if ($old_nb_jour < $cur_nb_jour) {
              $request->session()->flash('warning', 'Veuillez mettre à jour les dates de formations. Car vous avez changer le nombre de jour du "Plan Formation"');
            }

            $nb_filled_date = 0;
            $nb_empty_dates = 0;
            for ($i=0; $i < count($dates) ; $i++) {
              // Récupérer le nombre de date non nulls (ex: 3 dates avec valeur / le reste est null) == 3
              $cur_date_index = 'formations.'.$dates[$i]; //ex: date1
              $cur_date_val = PlanFormation::select('plan_formations.dt_debut', $cur_date_index)
                ->join('formations', 'plan_formations.n_form', 'formations.n_form')
                ->where([['formations.n_form', $plan->n_form], ['formations.groupe', 1]])
                ->first();
              ($cur_date_val == null) ?? $nb_empty_dates++;

              //get last nonull date (dernière date de formation)
              // $follow_date_val = null;
              // if ($plan->nb_grp == 1 && $i < 29) {
              //   $follow_date_index = 'formations.'.$dates[($i+1)];
              //   $follow_date_val = PlanFormation::select('plan_formations.dt_debut', $follow_date_index)
              //     ->join('formations', 'plan_formations.n_form', 'formations.n_form')
              //     ->where([['formations.n_form', $plan->n_form], ['formations.groupe', 1]])
              //     ->first();
              // } //endif
              // // modify lastnonull date
              // if ($cur_date_val->$cur_date_index != null && $follow_date_val->$follow_date_index == null && $plan->nb_grp == 1) {
              //     PlanFormation::select('plan_formations.dt_debut', $cur_date_index)
              //       ->join('formations', 'plan_formations.n_form', 'formations.n_form')
              //       ->where('plan_formations.n_form', $plan->n_form)
              //       ->update([$cur_date_index => $plan->dt_fin]);
              // } //endif
            } //endfor

            // Afficher un message si l'utilisateur a augmenter le nombre de jours
            // + mais n'a pas ajouter les dates dans "Formations"
            if ($nb_filled_date < $nb_empty_dates) {
              $request->session()->flash('warning', 'Vous n\'avez pas encore met à jour les dates de "Formation"');
            }

            // apporter les modification de l'"action_formation" sur "formations" s'il y a un seul groupe
<<<<<<< HEAD
=======
            //n_form primary key plan_formation
>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
            if ($plan->nb_grp == 1) {
              DB::table('plan_formations')
                ->join('formations', 'plan_formations.n_form', 'formations.n_form')
                ->where('plan_formations.n_form', $plan->n_form)
                ->update([
                    'formations.date1' => $plan->dt_debut,
                    'formations.nb_benif' => $plan->nb_partcp_total
                    ]);
            }
            $plan->save();

            //*** UPDATE INTERVENANT ***/
            if ($request->input("etat") != "annulé" || $request->input("etat") != "réalisé") {
                $interv = Intervenant::findOrFail($request->input("id_inv"));
                $interv->etat = "occupé";
                $interv->module = $nom_theme;
                $interv->save();
            }

            $request->session()->flash('updated', 'Modifié avec succès');
            return redirect('/detail-pf/'.$nform)->with('success');
        }
        else {
            $plan = PlanFormation::findOrFail($nform);

            $plans = Plan::all();
            $client = Client::all();
            $interv = Intervenant::all();
            $cabinet = Cabinet::all();
            $domain = Domaine::all();
            $theme = Theme::all();

            return view('planformation.edit', [
                'plan' => $plan,
                'plans' => $plans,
                'client' => $client,
                'interv' => $interv,
                'cabinet' => $cabinet,
                'domain' => $domain,
                'theme' => $theme,
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $nform, $id_plan)
    {
        $plan2 = PlanFormation::where('id_plan', $id_plan)->get();

        // sort data by dt_debut
        $planformation = collect($plan2)->sortBy('dt_debut');
        // \Log::info($planformation);

        // for ($i=0; $i < count($planformation); $i++) {
        //     $planformation[$i]['n_action'] = "TF".($i+1);
        // }
        // // delete data
        // PlanFormation::where('id_plan', $id_plan)->delete();

        // // for ($i=0; $i < count($planformation); $i++) {
        //     PlanFormation::insert($planformation->toArray());
        // // }

        //*** UPDATE INTERVENANT ***/
        DB::table('plan_formations as pf')
            ->join('intervenants as inv', 'pf.id_inv', '=', 'inv.id_interv')
            ->update(['inv.etat' => "disponible", 'inv.module' => '']);

        $plan = PlanFormation::findOrFail($nform);
        $plan->delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return back();
    }

<<<<<<< HEAD
=======
    public function avismodif(Request $request)
    {
      return view('planformation.avis-modif');
    }

    public function print_avismodif() {
      $client = Client::all();

    return view('planformation.avis-modif', ['client' => $client]);
  }



>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
}
