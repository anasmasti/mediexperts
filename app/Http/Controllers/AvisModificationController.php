<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{AvisModification,PlanFormation,Formation};


class AvisModificationController extends Controller
{

public function StoreUpdateAvisModif(Request $request) {

        if ($request -> isMethod('POST')) {

          $request = json_decode($request->getContent());

          $AvisModif = new AvisModification();

          $AvisModif->n_form = $request->nForm;
          $AvisModif->id_form = $request->idForm;
          $AvisModif->old_entreprise = $request->entreprise;
          $AvisModif->old_ref_plan = $request->refPlan;
          $AvisModif->old_type_action = $request->typeAction;
          $AvisModif->old_anulation = $request->annuler;
          $AvisModif->old_date_realisation = $request->modificationDate;
          $AvisModif->old_organisme_formations= $request->modificationOrganisme;
          $AvisModif->old_lieu_formations = $request->modificationLieu;
          $AvisModif->old_horaire_formations = $request->modificationHoraire;
          $AvisModif->old_theme_action = $request->NomTheme;
          $AvisModif->old_nature_action = $request->natureAction;
          $AvisModif->old_groupe = $request->groupe;
          $AvisModif->old_organisme = $request->organisme;
          $AvisModif->old_lieu= $request->lieu;
          $AvisModif->old_hr_debut= $request->heurDebut ;
          $AvisModif->old_hr_fin = $request->heurFin ;
          $AvisModif->old_pse_debut = $request->pause_debut;
          $AvisModif->old_pse_fin = $request->pause_fin;
          $AvisModif->old_date1 = $request->date1;
          $AvisModif->old_date2 = $request->date2;
          $AvisModif->old_date3 = $request->date3;
          $AvisModif->old_date4 = $request->date4 ;
          $AvisModif->old_date5 = $request->date5;
          $AvisModif->old_date6 = $request->date6;
          $AvisModif->old_date7 = $request->date7;
          $AvisModif->old_date8 = $request->date8;
          $AvisModif->old_date9 = $request->date9;
          $AvisModif->old_date10 = $request->date10;
          $AvisModif->pause = $request->pause;
          $nFrom = $AvisModif->n_form;
          $idForm = $AvisModif->id_form;
          $AvisModif->save();


          $planformation = PlanFormation::findOrFail($nFrom);

          $planformation->lieu = $request->newLieu;
          $planformation->organisme = $request->newOrganisme ;
          $planformation->type_action = $request->typeAction;
          $planformation->date_realisation = $request->modificationDate;
          $planformation->organisme_formations = $request->modificationOrganisme;
          $planformation->lieu_formations = $request->modificationLieu;
          $planformation->horaire_formations = $request->modificationHoraire;
          $planformation->save();

          $formation = Formation::findOrfail($idForm);

          $formation->hr_debut = $request-> newHeurDebut;
          $formation->hr_fin = $request-> newHeurFin;
          $formation->date1 =  $request->newdate1 ;
          $formation->date2 =  $request->newdate2;
          $formation->date3 =  $request->newdate3;
          $formation->date4 =  $request->newdate4;
          $formation->date5 =  $request->newdate5;
          $formation->date6 =  $request->newdate6;
          $formation->date7 =  $request->newdate7;
          $formation->date8 =  $request->newdate8;
          $formation->date9 =  $request->newdate9;
          $formation->date10 = $request->newdate10;
          $formation->save();

          // $formation->pse_debut = $request->pse_debut;
          // $formation->pse_fin = $request-> pse_fin;
        }
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
