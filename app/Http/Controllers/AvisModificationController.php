<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{AvisModification,PlanFormation};


class AvisModificationController extends Controller
{

public function StoreUpdateAvisModif(Request $request) {

        // if ($request -> isMethod('POST')) {

        //   $request = json_decode($request->getContent());

          $AvisModif = new AvisModification();

          $AvisModif->n_form = $request->nForm;
          $AvisModif->id_form = $request->idForm;
          $AvisModif->new_entreprise = $request->entreprise;
          $AvisModif->new_ref_plan = $request->refPlan;
          $AvisModif->new_type_action = $request->typeAction;
          $AvisModif->new_anulation = $request->annuler;
          $AvisModif->new_date_realisation = $request->modificationDate;
          $AvisModif->new_organisme_formations= $request->modificationOrganisme;
          $AvisModif->new_lieu_formations = $request->modificationLieu;
          $AvisModif->new_horaire_formations = $request->modificationHoraire;
          $AvisModif->new_theme_action = $request->NomTheme;
          $AvisModif->new_nature_action = $request->natureAction;
          $AvisModif->new_groupe = $request->groupe;
          $AvisModif->new_organisme = $request->newOrganisme;
          $AvisModif->new_lieu= $request->newLieu;
          $AvisModif->new_hr_debut= $request->newHeurDebut;
          $AvisModif->new_hr_fin = $request->newHeurFin ;
          $AvisModif->new_pse_debut = $request->pse_debut;
          $AvisModif->new_pse_fin = $request->pse_fin;
          $AvisModif->new_date1 = $request->newdate1;
          $AvisModif->new_date2 = $request->newdate2;
          $AvisModif->new_date3 = $request->newdate3;
          $AvisModif->new_date4 = $request->newdate4;
          $AvisModif->new_date5 = $request->newdate5;
          $AvisModif->new_date6 = $request->newdate6;
          $AvisModif->new_date7 = $request->newdate7;
          $AvisModif->new_date8 = $request->newdate8;
          $AvisModif->new_date9 = $request->newdate9;
          $AvisModif->new_date10 = $request->newdate10;
          $AvisModif->new_pause = $request->pause;
          $AvisModif->new_same_dates = $request->newSameDates;
          $nFrom = $AvisModif->n_form;
        //  $idForm = $AvisModif->id_form;
          $AvisModif->save();


          $planformation = PlanFormation::findOrFail($nFrom);
          $planformation->modificationDate;
          $planformation->modificationOrganisme;
          $planformation->modificationLieu;
          $planformation->modificationHoraire;
          $planformation->type_action = $request->typeAction;
          $planformation->etat = $request->typeAction;
          $planformation->save();
          
        
        // }
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
