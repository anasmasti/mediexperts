<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{AvisModification,PlanFormation,Formation};


class AvisModificationController extends Controller
{

public function StoreUpdateAvisModif(Request $request) {

        if ($request -> isMethod('POST')) {

          $request->validate([
            'entreprise',
            'ref_plan',
            'theme_action',
            'nature_action',
            'old_hr_debut',
            'old_hr_fin',
            'old_pse_debut',
            'old_pse_fin',
            'anulation',
            'date_realisation',
            'organisme_formations',
            'lieu_formations',
            'horaire_formations',
            'type_action',
            'old_organisme',
            'old_lieu',
            'groupe',
            'date1' =>'nullable',
            'date2' =>'nullable',
            'date3' =>'nullable',
            'date4' =>'nullable',
            'date5' =>'nullable',
            'date6' =>'nullable',
            'date7' =>'nullable',
            'date8' =>'nullable',
            'date9' =>'nullable',
            'date10' =>'nullable',
          ]);

          $AvisModif = new AvisModification();

          $AvisModif->n_form = $request->n_form;
          $AvisModif->old_entreprise = $request->old_entreprise;
          $AvisModif->old_ref_plan = $request->old_ref_plan;
          $AvisModif->old_type_action = $request->old_type_action;
          $AvisModif->old_anulation = $request->old_anulation;
          $AvisModif->old_date_realisation = $request->old_date_realisation;
          $AvisModif->old_organisme_formations= $request->old_organisme_formations;
          $AvisModif->old_lieu_formations = $request->old_lieu_formations;
          $AvisModif->old_horaire_formations = $request->old_horaire_formations;
          $AvisModif->old_theme_action = $request->old_theme_action;
          $AvisModif->old_nature_action= $request->old_nature_action;
          $AvisModif->old_groupe= $request->old_groupe;
          $AvisModif->old_organisme = $request->old_organisme;
          $AvisModif->old_lieu= $request->old_lieu;
          $AvisModif->old_hr_debut= $request->old_hr_debut ;
          $AvisModif->old_hr_fin= $request->old_hr_fin ;
          $AvisModif->old_pse_debut = $request->old_pse_debut;
          $AvisModif->old_pse_fin = $request->old_pse_fin;
          $AvisModif->old_date1= $request->old_date1;
          $AvisModif->old_date2 = $request->old_date2;
          $AvisModif->old_date3 = $request->old_date3;
          $AvisModif->old_date4= $request->old_date4 ;
          $AvisModif->old_date5 = $request->old_date5;
          $AvisModif->old_date6= $request->old_date6;
          $AvisModif->old_date7= $request->old_date7;
          $AvisModif->old_date8 = $request->old_date8;
          $AvisModif->old_date9 = $request->old_date9;
          $AvisModif->old_date10= $request->old_date10;
          $nFrom = $AvisModif->n_form;
          $AvisModif->save();



          $planformation = PlanFormation::findOrFail($nFrom);


          $planformation->lieu = $request->lieu;
          $planformation->organisme = $request->organisme ;
          $planformation->type_action = $request->type_action;
          $planformation->date_realisation = $request->date_realisation;
          $planformation->organisme_formations = $request->organisme_formations;
          $planformation->lieu_formations = $request->lieu_formations;
          $planformation->horaire_formations = $request->horaire_formations;

          $planformation->save();

          $formation = Formation::findOrFail($nFrom);

          $formation->hr_debut = $request-> hr_debut;
          $formation->hr_fin = $request-> hr_fin;
          $formation->pse_debut = $request->pse_debut;
          $formation->pse_fin = $request-> pse_fin;
          $formation->date1 = $request->date1;
          $formation->date2 = $request->date2;
          $formation->date3 = $request->date3;
          $formation->date4 = $request->date4;
          $formation->date5 = $request->date5;
          $formation->date6 = $request->date6;
          $formation->date7 = $request->date7;
          $formation->date8 = $request->date8;
          $formation->date9 = $request->date9;
          $formation->date10 = $request->date10;

          $formation->save();
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
