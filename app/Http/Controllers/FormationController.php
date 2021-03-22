<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Formation,PlanFormation,Client,Theme,Domaine,Personnel,Plan,Intervenant,FormationPersonnel};
<<<<<<< HEAD
use DB;
use Alert;
=======
use Illuminate\Support\Facades\DB;

>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8

class FormationController extends Controller
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

        $formation = Formation::all();
        // $plan = PlanFormation::all();

        return view('formation.view', ['formation' => $formation/*, 'plan' => $plan*/]);
    }

    public function search_form(Request $request)
    {
        $search_input = $request->input ( 'search_input' );
        $formation = Plan::select('formations.*')
            ->join('plan_formations', 'plan_formations.id_plan', 'plans.id_plan')
            ->join('formations', 'plan_formations.n_form', 'formations.n_form')
            ->where('plans.refpdf', 'LIKE', '%'. $search_input . '%')
            ->get();
        //get client
        return view('formation.view', ['formation'=>$formation]);
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

    //find nb jour de Plan de formation
    public function FindNbJours(Request $request) {
        // $data = PlanFormation::find($request->nform)->nbjour;
        $data = PlanFormation::select('n_form', 'nb_jour', 'nb_grp', 'dt_debut', 'dt_fin', 'nb_partcp_total')
                ->where('plan_formations.n_form', $request->nForm)
                ->get();
        return response()->json($data);
    }
    //find dates
    public function FindDates(Request $request) {
        $data = Formation::select(
          'formations.date1','formations.date2','formations.date3','formations.date4',
          'formations.date5','formations.date6','formations.date7','formations.date8',
          'formations.date9','formations.date10','formations.date11','formations.date12',
          'formations.date13','formations.date14','formations.date15','formations.date16',
          'formations.date17','formations.date18','formations.date19','formations.date20',
          'formations.date21','formations.date22','formations.date23','formations.date24',
          'formations.date25','formations.date26','formations.date27','formations.date28',
          'formations.date29','formations.date30')
            ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
            ->where('plan_formations.n_form', $request->nForm)
            ->get();
        return response()->json($data);
    }
    //find nb jour de Plan de formation
    public function FindPlanFormationProps(Request $request) {
        $data = PlanFormation::select('plan_formations.n_form', 'clients.raisoci', 'domaines.nom_domain', 'themes.nom_theme')
            ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
            ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
            ->join('Themes', 'themes.id_theme', '=', 'plan_formations.id_thm')
            ->join('domaines', 'domaines.id_domain', '=', 'themes.id_dom')
            ->get();
        return response()->json($data);
    }
    //trouver les personnels de l'entreprise a partir du "plan formation" choisi
    public function FindPersonnel(Request $request) {
      $data = PlanFormation::select('personnels.*')
        // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->join('personnels', 'clients.nrc_entrp', 'personnels.nrc_e')
        // ->join('formations_personnels', 'personnels.cin', 'formations_personnels.cin')
        // ->join('formations', 'formations_personnels.id_form', 'formations.id_form')
        ->where([['plan_formations.n_form', $request->nForm]/*, ['personnels.cin', 'NOT IN', 'formations_personnels.cin']*/])
        // ->orWhere([['plan_formations.n_form', $request->nForm], ['personnels.dt_demiss', '<', 'personnels.dt_embch']])
        ->get();
      return response()->json($data);
    }
    //trouver les personnels sélectionner pour la "formation"
    public function FindPersonnelFormation(Request $request) {
      $data = Personnel::select('personnels.*')
        ->join('formation_personnels', 'personnels.cin', 'formation_personnels.cin')
        ->join('formations', 'formation_personnels.id_form', 'formations.id_form')
        ->where('formations.id_form', $request->idForm)
        ->get();
      return response()->json($data);
    }
    //trouver les personnels déjà selectionné dans les autres groupes de formations
    public function FindPersonnelFormationDeja(Request $request) {
      $data = PlanFormation::select('personnels.*')
        ->join('formations', 'plan_formations.n_form', 'formations.n_form')
        ->join('formation_personnels', 'formations.id_form', 'formation_personnels.id_form')
        ->join('personnels', 'formation_personnels.cin', 'personnels.cin')
        ->where([['formations.id_form', '<>', $request->idForm], ['plan_formations.n_form', $request->nForm]])
        ->get();
      return response()->json($data);
    }
    public function FormationClient(Request $request)
    {
        $plan = Formation::select('formations.*')
        ->join('plans', 'plans.n_form', '=', 'formations.n_form')
        ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->where([['clients.nrc_entrp', '=', $request->nrc], ['plans.annee', '=', $request->annee]])
        ->get();

        return view('planformation.view', ['plan' => $plan]);
    }
    public function SaveNFacture(Request $request) {
      // $formation = Formation::findOrFail($request->nFacture);
      // $formation -> update();
      DB::table('formations')
            ->where('formations.id_form', $request->idForm)
            ->update(['formations.n_facture' => $request->nFacture, 'formations.dt_facture' => $request->dtFacture]);
      $data = Formation::find($request->idForm);
      return response()->json(['msg' => "Enregistré", $data]);
    }
    //find nb jour de Plan de formation
    public function VerifyGroupe(Request $request) {
        $data = Formation::select('formations.groupe')
                ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form', $request->nForm)
                ->where([['formations.groupe', $request->grp], ['formations.n_form', $request->nForm]])
                ->first();
        return response()->json($data);
    }


    public function DetailActionFormation(Request $request)
    {
        $formation = Formation::select('formations.*')
            ->join('plan_formations', 'plan_formations.n_form', '=', 'formations.n_form')
            // ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
            ->where('plan_formations.n_form', $request->nForm)
            ->get();

        return view('formation.view', ['formation' => $formation]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod("POST")) {

            $request->validate([
                // 'id_form' => 'required|unique:formations|max:50',
                'groupe' => 'required|max:50',
                'nb_benif' => 'required|max:50',
                'hr_debut' => 'required|max:50',
                'hr_fin' => 'required|max:50',
                'pse_debut' => 'required|max:50',
                'pse_fin' => 'required|max:50',
                'date1' => 'date',
                'date2' => 'date',
                'date3' => 'date',
                'date4' => 'date',
                'date5' => 'date',
                'date6' => 'date',
                'date7' => 'date',
                'date8' => 'date',
                'date9' => 'date',
                'date10' => 'date'
            ]);

            $plan = PlanFormation::all();
            $client = Client::all();
            $interv = Intervenant::all();

            $formation = Formation::create($request->except('cin'));

            $last_group = PlanFormation::select('formations.*')
                            ->join('formations', 'formations.n_form', 'plan_formations.n_form')
                            ->where('plan_formations.n_form', $request->input("n_form"))
                            ->count();
            $max_groupe = PlanFormation::find($request->input("n_form"))->nb_grp;
            if ($last_group > $max_groupe) {
                $request->session()->flash('error', 'Vous ne pouvez pas ajouter un autre groupe !');
                return view('formation.add', ['plan' => $plan, 'client' => $client])->with('error');
            }
            //// Génerer le groupe automatiquement
            // else ($last_group <= $maxgroupe) {
            //     DB::table('formations')
            //         ->where('formations.id_form', $formation->id_form)
            //         ->update(['formations.groupe' => $last_group]);
            // }

            //get all inputs at once (with the same name as "name[]")
<<<<<<< HEAD
=======

>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
            $cins = $request->cin;
            $counter = 0;
            if ($cins) {
                foreach ($cins as $cin) {
                    $form_pers = new FormationPersonnel;
                    $form_pers->id_form = $formation->id_form;
                    $form_pers->cin = $cin;
                    $form_pers->save();
                    $counter++;
                }
                if ($counter < $request->nb_benif) {
                    $request->session()->flash('warning', 'Vous devez encore sélectionner des participants !');
                    return redirect('/edit-form/'.$formation->id_form);
                }
                else if ($counter > $request->nb_benif) {
                    $request->session()->flash('error', 'Vous avez dépassé la limite du nombre de bénificiaires !');
                    return redirect('/edit-form/'.$formation->id_form);
                }
            }

            $request->session()->flash('added', 'Ajouté avec succès');

            return back()->with(['plan' => $plan, 'client' => $client])->with('success');
        }
        else {
            $plan = PlanFormation::all();
            $client = Client::all();
            $interv = Intervenant::all();

            return view('formation.add', ['plan' => $plan, 'interv' => $interv, 'client' => $client]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_form)
    {
      $formation = Formation::select('formations.*', 'formations.n_form as n_form_fk', 'formations.commentaire as comment_form',
        'plan_formations.*', 'clients.*', 'themes.*')
        ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
        ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
        ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
        ->where('formations.id_form', $id_form)
        ->first();
      $plan = PlanFormation::select('plan_formations.*', 'themes.*')
        ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
        ->join('formations', 'plan_formations.n_form', 'formations.n_form')
        ->where('formations.id_form', $id_form)
        ->first();
      $personnel = Personnel::select('personnels.*')
        ->join('formation_personnels', 'personnels.cin', 'formation_personnels.cin')
        ->join('formations', 'formation_personnels.id_form', 'formations.id_form')
        ->where('formations.id_form', $id_form)
        ->get();

      return view('formation.detail', ['formation' => $formation, 'plan' => $plan, 'personnel' => $personnel]);
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
    public function update(Request $request, $id_form)
    {
        if ($request->isMethod('POST')) {
            $formation = Formation::findOrFail($id_form);

            $request->validate([
                'groupe' => 'required|max:50',
                'nb_benif' => 'required|max:50',
                'hr_debut' => 'required|max:50',
                'hr_fin' => 'required|max:50',
                'pse_debut' => 'required|max:50',
                'pse_fin' => 'required|max:50',
                'date1' => 'date',
                'date2' => 'date',
                'date3' => 'date',
                'date4' => 'date',
                'date5' => 'date',
                'date6' => 'date',
                'date7' => 'date',
                'date8' => 'date',
                'date9' => 'date',
                'date10' => 'date'
            ]);

            $formation -> update($request->except('cin'));

            //supprimer la liste des participants de cette formation
            $form_pers = DB::table('formation_personnels')
              ->join('formations', 'formation_personnels.id_form', 'formations.id_form')
              ->where('formation_personnels.id_form', $id_form)
              ->delete();
            //re-créer les personnels dans cette formation
            $cins = $request->cin;
            $counter = 0;
            if ($cins) {
                foreach ($cins as $cin) {
                  $form_pers = new FormationPersonnel;
                  $form_pers->id_form = $formation->id_form;
                  $form_pers->cin = $cin;
                  $form_pers->save();
                  $counter++;
                }
                if ($counter < $request->nb_benif) {
                  $request->session()->flash('warning', 'Vous devez encore sélectionner des participants !');
                  return redirect('/edit-form/'.$formation->id_form);
                }
                else if ($counter > $request->nb_benif) {
                  $request->session()->flash('error', 'Vous avez dépassé la limite du nombre de bénificiaires !');
                  return redirect('/edit-form/'.$formation->id_form);
                }
            }

            $request->session()->flash('updated', 'Modifié avec succès');

            return redirect('/detail-form/'.$id_form)->with('success');
        }
        else {
          $formation = Formation::select(
            'formations.*', 'formations.n_form as n_form_fk', 'formations.commentaire as comment_form', 'plan_formations.*',
            'clients.nrc_entrp', 'clients.raisoci', 'themes.*')
              ->join('plan_formations', 'formations.n_form', 'plan_formations.n_form')
              ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
              // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
              ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
              ->join('Clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
              ->where('formations.id_form', $id_form)
              ->first();
          $plan = PlanFormation::select('plan_formations.*', 'themes.*', 'clients.*')
            ->join('themes', 'plan_formations.id_thm', 'themes.id_theme')
            // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
            ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
            ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
            ->get();
          // $personnel = Personnel::select('personnels.*', 'formation_personnels.*')
          //   ->join('formation_personnels', 'personnels.cin', 'formation_personnels.cin')
          //   ->join('formations', 'formation_personnels.id_form', 'formations.id_form')
          //   ->get();
          $personnel = PlanFormation::select('personnels.*')
            // ->join('clients', 'plan_formations.nrc_e', 'clients.nrc_entrp')
            ->join('plans', 'plans.id_plan', '=', 'plan_formations.id_plan')
            ->join('clients', 'clients.nrc_entrp', '=', 'plans.nrc_e')
            ->join('personnels', 'clients.nrc_entrp', 'personnels.nrc_e')
            ->where([['plan_formations.n_form', $request->input('n_form')], ['personnels.dt_demiss', null]])
            ->orWhere([['plan_formations.n_form', $request->input('n_form')], ['personnels.dt_demiss', '<', 'personnels.dt_embch']])
            ->get();

          $interv = Intervenant::all();

          return view('formation.edit', ['formation' => $formation, 'plan' => $plan, 'personnel' => $personnel, 'interv' => $interv]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_form)
    {
        $formation = Formation::findOrFail($id_form);
        $formation -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/formation');
    }
}
