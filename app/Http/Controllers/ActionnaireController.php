<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Validator;
use Illuminate\Http\Request;
use Session;
use App\{Actionnaire,Client};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Alert;

class ActionnaireController extends Controller
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

        $action = Actionnaire::all();
        $client = Client::all();

    return view('actionnaire.view', ['action'=>$action, 'client'=>$client]);
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

    public function searchact(Request $request)
    {
        $searchact = $request->input ('searchact');
        $action = Actionnaire::where('nom', 'LIKE', '%'. $searchact . '%')->get();
        $client = Client::all();
        return view('actionnaire.view', ['action'=>$action, 'client'=>$client]);
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
                // 'id_act' => 'required|max:15',
                'nrc_e' => 'required',
                'nom' => 'required|max:50',
                'prenom'  => 'required|max:50',
                'nb_acts' => 'required|max:3',
                'percent' => 'required|max:3',
                ]);

            Actionnaire::create($request->all());

            //avoid undefined value client by adding this
            $client = Client::all();

            $request->session()->flash('added', 'Ajouté avec succès');

        return view('actionnaire.add', ['client'=>$client])->with('success');
        }
        else {

            $client = Client::all();
            return view('actionnaire.add', ['client'=>$client]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_a)
    {
        $action = Actionnaire::findOrFail($id_a);
        $client = Client::all();

    return view('actionnaire.detail', ['action'=>$action, 'client' => $client]);
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
    public function update(Request $request, $id_a, $nrc_e)
    {
        if ($request -> isMethod('POST')) {

            $request->validate([
                'nrc_e' => 'required',
                'nom' => 'required|max:50',
                'prenom'  => 'required|max:50',
                'nb_acts' => 'required|max:3',
                'percent' => 'required|max:3',
            ]);

            $action = Actionnaire::findOrFail($id_a);
            $action -> update($request->all());

            $request->session()->flash('updated', 'Modifié avec succès');
        return redirect('/detail-act/'.$id_a.'/'.$nrc_e)->with('success');
        }
        else {
            $action = Actionnaire::findOrFail($id_a);

            $nrc = Client::findOrFail($nrc_e); //searching primary key
            $client = Client::all();

            return view('actionnaire.edit', ['action'=>$action, 'client'=>$client, 'nrc' => $nrc]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_a)
    {
        $action = Actionnaire::findOrFail($id_a);
        $action -> delete();
        
        $request->session()->flash('deleted', 'Supprimé avec succès');

    return redirect('/actionnaire');
    }
}
