<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{AvisModification,PlanFormation,Formation};
use Illuminate\Support\Facades\DB;

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
          $AvisModif->n_form = $request->input->input('');
          $AvisModif->entreprise = $request->input('');
          $AvisModif->ref_plan = $request->input('');
          $AvisModif->type_action = $request->input('');
          $AvisModif->anulation = $request->input('');
          $AvisModif->date_realisation = $request->input('');
          $AvisModif->organisme_formations = $request->input('');
          $AvisModif->lieu_formations = $request->input('');
          $AvisModif->horaire_formations = $request->input('');
          $AvisModif->theme_action = $request->input('');
          $AvisModif->nature_action = $request->input('');
          $AvisModif->groupe = $request->input('');
          $AvisModif->old_organisme = $request->input('');
          $AvisModif->old_lieu = $request->input('');
          $AvisModif->old_hr_debut = $request->input('');
          $AvisModif->old_hr_fin = $request->input('');
          $AvisModif->old_pse_debut = $request->input('');
          $AvisModif->old_pse_fin = $request->input('');
          $AvisModif->date1 = $request->input('');
          $AvisModif->date2 = $request->input('');
          $AvisModif->date3 = $request->input('');
          $AvisModif->date4 = $request->input('');
          $AvisModif->date5 = $request->input('');
          $AvisModif->date6 = $request->input('');
          $AvisModif->date7 = $request->input('');
          $AvisModif->date8 = $request->input('');
          $AvisModif->date9 = $request->input('');
          $AvisModif->date10 = $request->input('');

          $AvisModif->save();

          $nFrom = $request->input("n_form");

          if($request == $nFrom) {

            $planformation = PlanFormation::findOrFail($nFrom);

            $planformation->lieu = $request->input('');
            $planformation->organisme = $request->input('');
            $planformation->type_action = $request->input('');
            $planformation->date_realisation = $request->input('');
            $planformation->organisme_formations = $request->input('');
            $planformation->lieu_formations = $request->input('');
            $planformation->horaire_formations = $request->input('');

            $formation = Formation::findOrFail($nFrom);

            $formation->hr_debut = $request->input('');
            $formation->hr_fin = $request->input('');
            $formation->pse_debut = $request->input('');
            $formation->pse_fin = $request->input('');
            $formation->date1 = $request->input('');
            $formation->date2 = $request->input('');
            $formation->date3 = $request->input('');
            $formation->date4 = $request->input('');
            $formation->date5 = $request->input('');
            $formation->date6 = $request->input('');
            $formation->date7 = $request->input('');
            $formation->date8 = $request->input('');
            $formation->date9 = $request->input('');
            $formation->date10 = $request->input('');
          }
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
