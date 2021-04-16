<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{AvisModification,PlanFormation,Formation};
use Illuminate\Support\Facades\DB;

class AvisModificationController extends Controller
{

public function StoreUpdateAvisModif(Request $request) {

        if ($request -> isMethod('POST')) {

          // $request->validate([
          //   'entreprise',
          //   'ref_plan',
          //   'theme_action',
          //   'nature_action',
          //   'old_hr_debut',
          //   'old_hr_fin',
          //   'old_pse_debut',
          //   'old_pse_fin',
          //   'anulation',
          //   'date_realisation',
          //   'organisme_formations',
          //   'lieu_formations',
          //   'horaire_formations',
          //   'type_action',
          //   'old_organisme',
          //   'old_lieu',
          //   'groupe',
          //   'date1' =>'nullable',
          //   'date2' =>'nullable',
          //   'date3' =>'nullable',
          //   'date4' =>'nullable',
          //   'date5' =>'nullable',
          //   'date6' =>'nullable',
          //   'date7' =>'nullable',
          //   'date8' =>'nullable',
          //   'date9' =>'nullable',
          //   'date10' =>'nullable',
          // ]);

          $AvisModif = new AvisModification();
          $AvisModif->n_form = $request->n_form;
          $AvisModif->entreprise = $request->entreprise;
          $AvisModif->ref_plan = $request->ref_plan;
          $AvisModif->type_action = $request->type_action;
          $AvisModif->anulation = $request->anulation;
          $AvisModif->date_realisation = $request->date_realisation;
          $AvisModif->organisme_formations= $request->organisme_formations;
          $AvisModif->lieu_formations = $request->lieu_formations;
          $AvisModif->horaire_formations = $request->horaire_formations;
          $AvisModif->theme_action = $request->theme_action;
          $AvisModif->nature_action= $request->nature_action;
          $AvisModif->groupe= $request->groupe;
          $AvisModif->old_organisme = $request->old_organisme;
          $AvisModif->old_lieu= $request->old_lieu;
          $AvisModif->old_hr_debut= $request->old_hr_debut ;
          $AvisModif->old_hr_fin= $request->old_hr_fin ;
          $AvisModif->old_pse_debut = $request->old_pse_debut;
          $AvisModif->old_pse_fin = $request->old_pse_fin;
          $AvisModif->date1= $request->date1;
          $AvisModif->date2 = $request->date2;
          $AvisModif->date3 = $request->date3;
          $AvisModif->date4= $request->date4 ;
          $AvisModif->date5 = $request->date5;
          $AvisModif->date6= $request->date6 ;
          $AvisModif->date7= $request->date7 ;
          $AvisModif->date8 = $request->date8;
          $AvisModif->date9 = $request->date9;
          $AvisModif->date10= $request->date10;

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
