<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Intervenant,Cabinet,PlanFormation,MissionIntervenant};
use Alert;
use Illuminate\Support\Facades\Input;

class IntervenantController extends Controller
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

        $interv = Intervenant::all();
        $cabinet = Cabinet::all();
        $plan = PlanFormation::all();
        $misinv = MissionIntervenant::all();

    return view('intervenant.view', [
            'interv' => $interv,
            'cabinet' => $cabinet,
            'plan' => $plan,
            'misinv' => $misinv
        ]);
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
    public function searchinter(Request $request)
    {   $searchinter = $request->input ('searchinter');
        $interv = Intervenant::where('nom', 'LIKE', '%'. $searchinter . '%')->get();

        $cabinet = Cabinet::all();
        $plan = PlanFormation::all();
        $misinv = MissionIntervenant::all();

        return view('intervenant.view', [
                'interv' => $interv,
                'cabinet'=>$cabinet,
                'plan' => $plan,
                'misinv' => $misinv
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
                // 'id_interv' => 'required|unique:intervenants|max:15',
                'nrc_c' => 'required',
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'specif' => 'required|max:900',
                'dom_interv' => 'required|max:900',
                // 'module' => 'required|max:500',
                'tele' => 'unique:intervenants|max:14',
                'email' => 'unique:intervenants|max:50',
                'langs' => 'required|max:50',
                'cv' => 'required',
                'commentaire' => 'max:1000'
            ]);

            $interv = new Intervenant();
            // $interv->id_interv = $request->input('id_interv');
            $interv->nrc_c = $request->input('nrc_c');
            $interv->nom = $request->input('nom');
            $interv->prenom = $request->input('prenom');
            $interv->specif = $request->input('specif');
            $interv->dom_interv = $request->input('dom_interv');
            $interv->module = $request->input('module');
            $interv->tele = $request->input('tele');
            $interv->email = $request->input('email');
            $interv->langs = $request->input('langs');
            $interv->commentaire = $request->input('commentaire');

            //if ($request->hasFile('cv'))
            //{
            //}
            $image = $request->file('cv');
            $Name = time() . "-CV." . $image->getClientOriginalExtension();
            $path = 'img/interv-files/';
            $image_url = $path . $Name;
            $image->move($path, $Name);
            $interv->cv = $image_url;

            $interv->save();

            //get data from
            $cabinet = Cabinet::all();

            //guide message
            (Intervenant::all()->count() <= 1) ?? $request->session()->flash('info',
            'Un intervenant c\'est une personne qui peut réaliser des missions ou des formations');

            $request->session()->flash('added', 'Ajouté avec succès');
        return view('intervenant.add', ['cabinet'=>$cabinet])->with('success');
        }
        else {
            //get foreignkey
            $cabinet = Cabinet::all();

            return view('intervenant.add', ['cabinet'=>$cabinet]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_i)
    {
        $interv = Intervenant::findOrFail($id_i);

        $cabinet = Cabinet::all();

        $plan = PlanFormation::all();
        $misinv = MissionIntervenant::all();

    return view('intervenant.detail', [
        'cabinet'=>$cabinet,
        'interv'=>$interv,
        'plan' => $plan,
        'misinv' => $misinv
        ]);
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
    public function update(Request $request, $id_i)
    {
        if ($request -> isMethod('POST')) {

            $interv = Intervenant::findOrFail($id_i);

            $request->validate([
                'nrc_c' => 'required',
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'specif' => 'required|max:900',
                'dom_interv' => 'required|max:900',
                // 'module' => 'required|max:500',
                'tele' => 'required|max:14|unique:intervenants,tele,'.$interv->id_interv.',id_interv',
                'email' => 'required|max:50|unique:intervenants,email,'.$interv->id_interv.',id_interv',
                'langs' => 'required|max:50',
                'cv' => 'required',
                'commentaire' => 'max:1000'
            ]);

            $interv->nrc_c = $request->input('nrc_c');
            $interv->nom = $request->input('nom');
            $interv->prenom = $request->input('prenom');
            $interv->specif = $request->input('specif');
            $interv->dom_interv = $request->input('dom_interv');
            $interv->module = $request->input('module');
            $interv->tele = $request->input('tele');
            $interv->email = $request->input('email');
            $interv->langs = $request->input('langs');
            $interv->commentaire = $request->input('commentaire');

            //if ($request->hasFile('cv'))
            //{
            //}
            $image = $request->file('cv');
            $Name = time() . "-CV." . $image->getClientOriginalExtension();
            $path = 'img/interv-files/';
            $image_url = $path . $Name;
            $image->move($path, $Name);
            $interv->cv = $image_url;

            $interv->save();

            $request->session()->flash('updated', 'Modifié avec succès');

        return redirect('/detail-inv/'.$id_i)->with('success');
        }
        else {
            $interv = Intervenant::findOrFail($id_i);

            $cabinet = Cabinet::all();

            return view('intervenant.edit', ['cabinet'=>$cabinet, 'interv'=>$interv]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_i)
    {
        $interv = Intervenant::findOrFail($id_i);
        $interv -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

    return redirect('/intervenant');
    }
}
