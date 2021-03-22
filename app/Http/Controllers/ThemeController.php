<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Theme, Domaine};
//use Alert;

class ThemeController extends Controller
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

        $theme = Theme::all();
        $domain = Domaine::all();

        return view('theme.view', ['theme' => $theme, 'domain' => $domain]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_theme = $request->input('search');
        $theme = Theme::select('themes.*', 'domaines.*')
            ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
            ->where('themes.nom_theme', 'LIKE', '%'. $search_theme . '%')
            ->orWhere('domaines.ville', 'LIKE', '%'. $search_theme . '%')
            ->get();
        $domain = Domaine::all();

        return view('theme.view', ['theme' => $theme, 'domain' => $domain]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod("POST")) {

            $request->validate([
                // 'id_theme' => 'required|max:50',
                'nom_theme' => 'required|max:300',
                'objectif' => 'required|max:3000',
                'contenu' => 'required|max:3000',
                'id_dom' => 'required|max:40',
                'commentaire' => 'max:3000',
            ]);

            Theme::create($request->all());

            $theme = Theme::all();
            $domain = Domaine::all();

            $request->session()->flash('added', 'Ajouté avec succès');
            return view('theme.add', ['domain' => $domain, 'theme' => $theme])->with('success');
        }
        else {
            $theme = Theme::all();
            $domain = Domaine::all();
            return view('theme.add', ['domain' => $domain, 'theme' => $theme]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_theme)
    {
        $theme = Theme::findOrFail($id_theme);

        $domain = Domaine::all();

        return view('theme.detail', ['theme' => $theme, 'domain' => $domain]);
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
    public function update(Request $request, $id_theme)
    {
        if ($request->isMethod('POST')) {
            $theme = Theme::findOrFail($id_theme);

            $request->validate([
                'nom_theme' => 'required|max:300',
                'objectif' => 'required|max:3000',
                'contenu' => 'required|max:3000',
                'id_dom' => 'required|max:40',
                'commentaire' => 'max:3000',
            ]);

            $theme -> update($request->all());
            // Alert::success('Success Message', 'Modifié avec succès');


            $domain = Domaine::all();

            return redirect('/detail-theme/'.$id_theme)->with('success');
        }
        else {
            $theme = Theme::findOrFail($id_theme);

            $domain = Domaine::all();

            return view('theme.edit', ['theme' => $theme, 'domain' => $domain]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_theme)
    {
        $theme = Theme::findOrFail($id_theme);
        $theme -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/theme');
    }
}
