<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personnel;
use App\Client;
use App\FormationPersonnel;
use Illuminate\Support\Facades\DB;

class PersonnelController extends Controller
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

        $personnel = Personnel::all();

        return view('personnel.view', ['personnel' => $personnel]);
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

    public function searchPersonnel(Request $request)
    {   $search = $request->input('search');
        $personnel = Personnel::select('clients.raisoci', 'clients.nrc_entrp', 'personnels.*')
            ->join('clients', 'personnels.nrc_e', 'clients.nrc_entrp')
            ->where('personnels.nom', 'like', '%'. $search . '%')
            ->orWhere('personnels.prenom', 'like', '%'. $search . '%')
            ->orWhere('personnels.cin', 'like', '%'. $search . '%')
            ->orWhere('personnels.matricule', 'like', '%'. $search . '%')
            ->orWhere('clients.nrc_entrp', 'like', '%'. $search . '%')
            ->orWhere('clients.raisoci', 'like', '%'. $search . '%')
            ->get();

        $client = Client::all();

        return view('personnel.view', [
                'client' => $client,
                'personnel'=>$personnel
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request -> isMethod('POST')) {

            $request->validate([
                'cin' => 'required|unique:personnels|max:15',
                'matricule' => 'required|unique:personnels|max:15',
                'nrc_e' => 'required|max:50',
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'cnss' => 'required|unique:personnels|max:12',
                'dt_naiss' => 'required|date|before:'.date('Y-m-d'),
                'dt_embch' => 'required|date|before_or_equal:'.date('Y-m-d'),
                'dt_demiss' => 'nullable|date|before_or_equal:'.date('Y-m-d'),
                'fonction' => 'required|max:50',
                'csp' => 'required|max:10',
                'etat' => 'required|max:10',
            ]);

            Personnel::create($request->all());
            $client = Client::all();

            $request->session()->flash('added', 'Ajout?? avec succ??s');
        return view('personnel.add', ['client' => $client])->with('success');
        }
        else {
            $client = Client::all();
            return view('personnel.add', ['client' => $client]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $cin)
    {
        $personnel = Personnel::findOrFail($cin);

        return view('personnel.detail', ['personnel' => $personnel]);
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
    public function update(Request $request, $cin)
    {
        if ($request -> isMethod('POST')) {

            $personnel = Personnel::findOrFail($cin);

            $request->validate([
              'matricule' => 'required|unique:personnels',
              'nrc_e' => 'required|max:50',
              'nom' => 'required|max:50',
              'prenom' => 'required|max:50',
              'cnss' => 'required|unique:personnels|max:12',
              'dt_naiss' => 'required|date|before:'.date('Y-m-d'),
              'dt_embch' => 'required|date|before_or_equal:'.date('Y-m-d'),
              'dt_demiss' => 'nullable|date|before_or_equal:'.date('Y-m-d'),
              'fonction' => 'required|max:50',
              'csp' => 'required|max:10',
              'etat' => 'required|max:10',
            ]);

            $personnel -> update($request->all());

            $request->session()->flash('updated', 'Modifi?? avec succ??s');
        redirect('/detail-pers/'.$cin)->with('success');
        }
        else {
            $personnel = Personnel::findOrFail($cin);
            $client = Client::all();
            return view('personnel.edit', ['personnel' => $personnel, 'client' => $client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cin)
    {
        DB::table('personnels')
            ->where('cin', $cin)
            ->delete();
        // $personnel = Personnel::findOrFail($cin);
        // $personnel -> delete();

        $request->session()->flash('deleted', 'Supprim?? avec succ??s');

        redirect('/personnel');
    }

    public function deleteMultiple(Request $request)
    {
        // $cins = $request->input('cin', []);
        $cins = $request->cin;
        if ($cins) {
          foreach ($cins as $cin) {
            // 1- v??rifier si le personnel est d??j?? dans une formation
            $targetPersonnel = FormationPersonnel::where('formation_personnels.cin', $cin)->first();
            if ($targetPersonnel) {
                // 2- emp??cher la suppression
                $request->session()->flash('error', 'Impossible de supprimer le personnel '.$cin.'. Car il est affect?? dans une formation');
            } else {
                // 2??- sinon supprimer le personnel
                Personnel::where('cin', $cin)->delete();
                $request->session()->flash('deleted', 'Supprim??s avec succ??s');
            }
          }
        } else {
            $request->session()->flash('warning', 'Veuillez s??lectionner au moins un enregistrement!');
        }
        return back();

    }
}
