<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\{DemandeFinancement,Client,Cabinet,Intervenant,DemandeRemboursementGiac,Plan,PlanFormation,Formation,Personnel,MissionIntervenant,Giac,Domaine,Theme};
use DB;
=======

use App\{DemandeFinancement,Client,Cabinet,Intervenant,DemandeRemboursementGiac,Plan,PlanFormation,Formation,Personnel,MissionIntervenant,Giac,Domaine,Theme};
use Illuminate\Support\Facades\DB;
>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8

use Illuminate\Http\Request;

class FicheMissionController extends Controller
{
    // Attestation de référence DF Cabinet
    public function print_att_reference_df_cab(Request $request) {
      $client = Client::all();
      $cabinet = Cabinet::all();
      return view('_formulaires.att-reference-df-cab', ['client' => $client, 'cabinet' => $cabinet]);
    }
    public function FillDFList(Request $request) {
      $data = Client::select('clients.*', 'demande_financements.*')
        ->join('demande_financements', 'clients.nrc_entrp', 'demande_financements.nrc_e')
        ->where('demande_financements.nrc_e', $request->nrcEntrp)
        ->get();

      return response()->json($data);
    }
    public function FindDFInfo(Request $request) {
      $data = DemandeFinancement::find($request->ndf);
      return response()->json($data);
    }
    public function FindCabinetInfo(Request $request) {
      $data = Cabinet::find($request->nrcCab);
      return response()->json($data);
    }

    // Attestation de référence DF Intervenant
    public function print_att_reference_df_inv(Request $request) {
      $client = Client::all();
      $cabinet = Cabinet::all();
      $interv = Intervenant::all();
      return view('_formulaires.att-reference-df-inv', ['client' => $client, 'cabinet' => $cabinet, 'interv' => $interv]);
    }
    public function FindIntervInfo(Request $request) {
      $data = Intervenant::find($request->idInv);
      return response()->json($data);
    }
}
