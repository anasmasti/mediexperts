<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Giac;
use Alert;
use Session;
use Illuminate\Support\Facades\Input;

class GiacController extends Controller
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

        $giac = Giac::all();

    return view('giac.view', ['giac' => $giac]);
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

    public function searchgiac(Request $request)
    {   $searchgiac = $request->input ('searchgiac');
        $giac = Giac::where('libelle', 'LIKE', '%'. $searchgiac . '%')->get();

        return view('giac.view', ['giac' => $giac]);
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
                // 'code_giac' => 'required|unique:giacs|max:15',
                'libelle' => 'required|unique:giacs|max:50',
                'specif' => 'required|max:50',
                'adlocal_1' => 'required|max:100',
                'adlocal_2' => 'required|max:100',
                'tele' => 'required|max:14',
                'fax' => 'required|max:14',
                'email' => 'required|unique:giacs|max:50',
                'website' => 'required|unique:giacs|max:50',
                'nom_dg' => 'required|max:50',
                'tel_dg' => 'required|max:50',
                'email_dg' => 'required|max:50',
                'nom_resp' => 'required|max:50',
                'tel_resp' => 'required|max:14',
                'email_resp' => 'required|max:50',
                'commentaire' => 'max:900'
            ]);

            Giac::create($request->all());

            $request->session()->flash('added', 'Ajouté avec succès');

        return view('giac.add')->with('success');
        }
        return view('giac.add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code)
    {
        $giac = Giac::findOrFail($code);

    return view('giac.detail', ['giac' => $giac]);
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
    public function update(Request $request, $code)
    {
        if ($request -> isMethod('POST')) {

            $giac = Giac::findOrFail($code);

            $request->validate([
                'libelle' => 'required|max:50|unique:giacs,libelle,'.$giac->code_giac.',code_giac',
                'specif' => 'required|max:50',
                'adlocal_1' => 'required|max:100',
                'adlocal_2' => 'required|max:100',
                'tele' => 'required|max:14',
                'fax' => 'required|max:14',
                'email' => 'required|max:50|unique:giacs,email,'.$giac->code_giac.',code_giac',
                'website' => 'required|max:50|unique:giacs,website,'.$giac->code_giac.',code_giac',
                'nom_dg' => 'required|max:50',
                'tel_dg' => 'required|max:50',
                'email_dg' => 'required|max:50',
                'nom_resp' => 'required|max:50',
                'tel_resp' => 'required|max:14',
                'email_resp' => 'required|max:50',
                'commentaire' => 'max:900'
            ]);

            $giac -> update($request->all());

            $request->session()->flash('updated', 'Modifié avec succès');

        return redirect('/detail-gc/'.$code)->with('success');
        }
        else {
            $giac = Giac::findOrFail($code);

        return view('giac.edit', ['giac' =>$giac]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $code)
    {
        $giac = Giac::findOrFail($code);
        $giac -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

    return redirect('/giac');
    }
}
