<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Domaine, ActionFormation, Theme};
use Alert;
use DB;

class DomaineController extends Controller
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

        $domain = Domaine::all();
        $theme = Theme::all();

        return view('domaine.view', ['domain' => $domain, 'theme' => $theme]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search_input = $request->input ('search');
        $domain = Domaine::where('nom_domain', 'LIKE', '%'. $search_input . '%')
            ->orWhere('ville', 'LIKE', '%'. $search_input . '%')
            ->orWhere('cout', 'LIKE', '%'. $search_input . '%')
            ->get();

        $theme = Theme::all();

        return view('domaine.view', ['domain' => $domain, 'theme' => $theme]);
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
                'nom_domain' => 'required|max:300',
                'region' => 'required|max:50',
                'cout' => 'required|max:50',
                'ville' => 'required|max:50',
                'commentaire' => 'max:3000',
            ]);
            Domaine::create($request->all());
            $count_theme = Theme::where('id_dom', '=', $request->input('id_domain'))->count();
            if ($count_theme == 0) {
                $request->session()->flash('warning', 'Veuillez associer des thèmes au domaine ajouté !');
            }
            $request->session()->flash('added', 'Ajouté avec succès');

        return view('domaine.add')->with('success');
        }
        return view('domaine.add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_domain)
    {
        $domain = Domaine::findOrFail($id_domain);
        $theme = Theme::all();

        return view('domaine.detail', ['domain' => $domain, 'theme' => $theme]);
    }
    public function ShowThemesDomaine(Request $request, $id_domain)
    {
        $theme = Theme::select('themes.*')
            ->join('domaines', 'themes.id_dom', 'domaines.id_domain')
            ->where('domaines.id_domain', $id_domain)
            ->get();
        $domain = Domaine::all();

        return view('theme.view', ['domain' => $domain, 'theme' => $theme]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_domain)
    {
        if ($request->isMethod('POST')) {
            $domain = Domaine::findOrFail($id_domain);
            $request->validate([
                'nom_domain' => 'required|max:300',
                'region' => 'required|max:50',
                'cout' => 'required|max:50',
                'ville' => 'required|max:50',
                'commentaire' => 'max:3000',
            ]);
            $domain -> update($request->all());
            $request->session()->flash('updated', 'Modifié avec succès');

            // vérifier si une action prend déjà un id domaine
            $plan_formation = ActionFormation::where('id_dom', $id_domain)->get();
            if ($plan_formation) {
                foreach ($plan_formation as $pf) {
                    // vérifier si le cout domaine != budget par jour
                    // + si oui on va modifier budget par jour dans 'action_formations'
                    if ($pf->bdg_jour != $domain->cout) {
                        // récupérer le nombre de jours pour calculer le 'budget total'
                        $nb_jour = ActionFormation::select("nb_jour")->where('n_form', $pf->n_form)->first();
                        $plan = ActionFormation::findOrFail($pf->n_form);
                        $plan->bdg_jour = $domain->cout;
                        $plan->bdg_total = $domain->cout * $nb_jour["nb_jour"];
                        $plan->save();

                        $request->session()->flash('info', 'Le budget des Actions de formation relative à ce domaine à été modifié!');
                    }
                } // foreach
            }

            return redirect('/detail-domain/'.$id_domain)->with('success');
        }
        else {
            $domain = Domaine::findOrFail($id_domain);

            return view('domaine.edit', ['domain' => $domain]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_domain)
    {
        $domain = Domaine::findOrFail($id_domain);
        $domain -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

        return redirect('/domain');
    }
}
