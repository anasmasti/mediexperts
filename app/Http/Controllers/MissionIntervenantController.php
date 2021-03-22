<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
use App\{MissionIntervenant,Intervenant,DemandeFinancement};
use Illuminate\Support\Facades\DB;
//use Alert;

class MissionIntervenantController extends Controller
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

        $misinv = MissionIntervenant::all();
        $df = DemandeFinancement::all();
        $interv = Intervenant::all();

        return view('mission_interv.view', ['misinv'=>$misinv,'df'=>$df,'interv'=>$interv]);
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
    public function searchmiss(Request $request)
    {   $searchmiss = $request->input ( 'searchmiss' );
        $misinv = MissionIntervenant::where('id', 'LIKE', '%'. $searchmiss . '%')->get();

        $df = DemandeFinancement::all();
        $interv = Intervenant::all();
        return view('mission_interv.view', ['misinv' => $misinv, 'df'=>$df, 'interv'=>$interv]);
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
                'id' => 'required|unique:mission_intervenants',
                'id_interv' => 'required|unique:mission_intervenants',
                'n_df' => 'required|unique:mission_intervenants',
            ]);

            MissionIntervenant::create($request->all());

            $df = DemandeFinancement::all();
            $interv = Intervenant::all();

            $request->session()->flash('added', 'Ajouté avec succès');
            return view('mission_interv.add', ['df'=>$df, 'interv'=>$interv])->with('success');
        }
        else {
            $df = DemandeFinancement::all();
            $interv = Intervenant::all();

            return view('mission_interv.add', ['df'=>$df, 'interv'=>$interv])->with('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $misinv = MissionIntervenant::findOrFail($id);

        $ndf = DemandeFinancement::findOrFail($n_df);
        $df = DemandeFinancement::all();

        $idi = Intervenant::findOrFail($id_i);
        $interv = Intervenant::all();

        return view('mission_interv.detail', [
            'misinv'=>$misinv,
            'n_df'=>$n_df,
            'df'=>$df,
            'idi'=>$idi,
            'interv'=>$interv]);
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
        if ($request -> isMethod('POST')) {

            $misinv = MissionIntervenant::findOrFail($id);

            $request->validate([
                'id_interv' => 'required|unique:mission_intervenants,id_interv,'.$misinv->id.',id',
                'n_df' => 'required|unique:mission_intervenants,n_df,'.$misinv->id.',id',
            ]);


            $misinv -> update($request->all());

            $request->session()->flash('updated', 'Modifié avec succès');

            return redirect('/detail-mis-inv/'.$id);
        }
        else {
            $misinv  = MissionIntervenant::findOrFail($id);

            $idi = Intervenant::findOrFail($id_i);
            $interv = Intervenant::all();

            $ndf = DemandeFinancement::findOrFail($n_df);
            $df = DemandeFinancement::all();

            return view('mission_interv.edit', [
                'misinv'=>$misinv,
                'ndf'=>$ndf,
                'df'=>$df,
                'idi'=>$idi,
                'interv'=>$interv]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $misinv = MissionIntervenant::findOrFail($id);
        $misinv -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/mis-inv');
    }
}
