<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{AvisModification, PlanFormation};


class AvisModificationController extends Controller
{

    public function StoreUpdateAvisModif(Request $request)
    {


        if ($request->isMethod('POST')) {

            // $request = json_decode($request->getContent());
           
            // return response($request, 200);

            $rules = [
                'new_type_action' => 'required',
            ];
        
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];
        
            $this->validate($request, $rules, $customMessages);


            $AvisModif = new AvisModification();

            $AvisModif->n_form = $request->n_form;
            $AvisModif->id_form = $request->id_form;
            $AvisModif->new_entreprise = $request->new_entreprise;
            $AvisModif->new_ref_plan = $request->new_ref_plan;
            $AvisModif->new_type_action = $request->new_type_action;
            $AvisModif->new_anulation = $request->new_anulation;
            $AvisModif->new_date_realisation = $request->new_date_realisation;
            $AvisModif->new_organisme_formations = $request->new_organisme_formations;
            $AvisModif->new_lieu_formations = $request->new_lieu_formations;
            $AvisModif->new_horaire_formations = $request->new_horaire_formations;
            $AvisModif->new_theme_action = $request->new_theme_action;
            $AvisModif->new_nature_action = $request->new_nature_action;
            //   $AvisModif->new_groupe = $request->new_groupe;
            $AvisModif->new_organisme = $request->new_organisme;
            $AvisModif->new_lieu = $request->new_lieu;
            $AvisModif->new_hr_debut = $request->new_hr_debut;
            $AvisModif->new_hr_fin = $request->new_hr_fin;
            $AvisModif->new_pse_debut = $request->new_pse_debut;
            $AvisModif->new_pse_fin = $request->new_pse_fin;
            $AvisModif->new_date1 = $request->new_date1;
            $AvisModif->new_date2 = $request->new_date2;
            $AvisModif->new_date3 = $request->new_date3;
            $AvisModif->new_date4 = $request->new_date4;
            $AvisModif->new_date5 = $request->new_date5;
            $AvisModif->new_date6 = $request->new_date6;
            $AvisModif->new_date7 = $request->new_date7;
            $AvisModif->new_date8 = $request->new_date8;
            $AvisModif->new_date9 = $request->new_date9;
            $AvisModif->new_date10 = $request->new_date10;
            $AvisModif->new_pause = $request->new_pause;
            $AvisModif->new_has_same_dates = $request->new_has_same_dates;
            $nFrom = $AvisModif->n_form;
            //  $idForm = $AvisModif->id_form;
            $AvisModif->save();


            $planformation = PlanFormation::findOrFail($nFrom);
            $planformation->date_realisation = $request->new_date_realisation;
            $planformation->organisme_formations = $request->new_organisme_formations;
            $planformation->lieu_formations = $request->new_lieu_formations;
            $planformation->horaire_formations = $request->new_horaire_formations;
            $planformation->type_action = $request->new_type_action;
            $planformation->etat = $request->new_type_action;
            $planformation->save();
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
