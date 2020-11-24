<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Cabinet,Intervenant};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Alert;
use PDF;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //clean session keys
        $request->session()->forget(['added', 'updated', 'success', 'info', 'warning', 'error']);

        $cabinet = Cabinet::all();
        $interv = Intervenant::all();
        return view('cabinet.view', ['cabinet'=>$cabinet, 'interv'=>$interv]);
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

    public function searchcabinet(Request $request)
    {   $searchcabinet = $request->input ('search_input');
        $cabinet = Cabinet::where('raisoci', 'LIKE', '%'. $searchcabinet . '%')->get();
        $interv = Intervenant::all();
        return view('cabinet.view', ['cabinet' => $cabinet, 'interv'=>$interv]);
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

        //clean session keys
        // $request->session()->forget(['added', 'updated', 'deleted', 'success', 'info', 'warning', 'error']);

        $request->validate([
            'nrc_cab' => 'required|unique:cabinets|max:15',
            'raisoci' => 'required|unique:cabinets|max:50',
            'formjury'=> 'required|max:50',
            'cap_soci' => 'required|max:15',
            'dt_creat'=> 'required|date|before:'.date('Y-m-d'),
            'dom_compet1'=> 'required|max:50',
            'dom_compet2'=> 'required|max:50',
            'dom_compet3'=> 'required|max:50',
            'materiel1'=> 'required|max:50',
            'materiel2'=> 'required|max:50',
            'materiel3'=> 'required|max:50',
            'id_fiscal'=> 'required|unique:cabinets|max:15',
            'ncnss'=> 'required|unique:cabinets|max:15',
            'npatente'=> 'required|unique:cabinets|max:15',
            'effectif'=> 'required|max:5',
            'nb_permanent'=> 'required|max:5',
            'nb_vacataire'=> 'required|max:5',
            'nb_formateur'=> 'required|max:5',
            'effectif_etr'=> 'required|max:5',
            'nb_permanent_etr'=> 'required|max:5',
            'nb_vacataire_etr'=> 'required|max:5',
            'nb_formateur_etr'=> 'required|max:5',
            'nom_gr1'=> 'required|max:50',
            'pren_gr1'=> 'required|max:50',
            'qualit_gr1'=> 'required|max:50',
            'nom_gr2'=> 'required|max:50',
            'pren_gr2'=> 'required|max:50',
            'qualit_gr2'=> 'required|max:50',
            'adress'=> 'required|max:150',
            'ville'=> 'required|max:150',
            'tele'=> 'required|max:14',
            'fax'=> 'required|max:14',
            'email'=> 'required|unique:cabinets|max:50',
            'website'=> 'required|unique:cabinets|max:50',
            'commentaire' => 'max:1000'
        ]);

            Cabinet::create($request->all());
            $cabinet  = Cabinet::all();

            $request->session()->flash('added', 'Ajouté avec succès');

            $count_interv = Intervenant::where('nrc_c', '=', $request->input('nrc_cab'))->count();
            if ($count_interv == 0) {
                $request->session()->flash('warning', 'Veuillez associer des intervenants au cabinet ajouté !');
            }

        return view('cabinet.add', ['cabinet'=>$cabinet])->with('success');

        }
        else {
            $cabinet  = Cabinet::all();
            return view('cabinet.add', ['cabinet'=>$cabinet]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $nrc_c)
    {
        //clean session keys
        // $request->session()->forget(['added', 'deleted', 'success', 'info', 'warning', 'error']);

        $cabinet = Cabinet::findOrFail($nrc_c);
        $interv = Intervenant::all();

    return view('cabinet.detail', ['cabinet'=>$cabinet, 'interv'=>$interv]);
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
    public function update(Request $request, $nrc_c)
    {
        if ($request -> isMethod('POST')) {

            //clean session keys
            // $request->session()->forget(['added', 'updated', 'deleted', 'success', 'info', 'warning', 'error']);

            $cabinet = Cabinet::findOrFail($nrc_c);
            $request->validate([
                'raisoci' => 'required|max:50|unique:cabinets,raisoci,'.$cabinet->nrc_cab.',nrc_cab',
                'formjury'=> 'required|max:50',
                'cap_soci' => 'required|max:15',
                'dt_creat'=> 'required|date|before_or_equal:'.date('Y-m-d'),
                'dom_compet1'=> 'required|max:50',
                'dom_compet2'=> 'required|max:50',
                'dom_compet3'=> 'required|max:50',
                'materiel1'=> 'required|max:50',
                'materiel2'=> 'required|max:50',
                'materiel3'=> 'required|max:50',
                'id_fiscal'=> 'required|max:15|unique:cabinets,id_fiscal,'.$cabinet->nrc_cab.',nrc_cab',
                'ncnss'=> 'required|max:15|unique:cabinets,ncnss,'.$cabinet->nrc_cab.',nrc_cab',
                'npatente'=> 'required|max:15|unique:cabinets,npatente,'.$cabinet->nrc_cab.',nrc_cab',
                'effectif'=> 'required|max:5',
                'nb_permanent'=> 'required|max:5',
                'nb_vacataire'=> 'required|max:5',
                'nb_formateur'=> 'required|max:5',
                'effectif_etr'=> 'required|max:5',
                'nb_permanent_etr'=> 'required|max:5',
                'nb_vacataire_etr'=> 'required|max:5',
                'nb_formateur_etr'=> 'required|max:5',
                'nom_gr1'=> 'required|max:50',
                'pren_gr1'=> 'required|max:50',
                'qualit_gr1'=> 'required|max:50',
                'nom_gr2'=> 'required|max:50',
                'pren_gr2'=> 'required|max:50',
                'qualit_gr2'=> 'required|max:50',
                'adress'=> 'required|max:150',
                'ville'=> 'required|max:150',
                'tele'=> 'required|max:14',
                'fax'=> 'required|max:14',
                'email'=> 'required|max:50|unique:cabinets,email,'.$cabinet->nrc_cab.',nrc_cab',
                'website'=> 'required|max:50|unique:cabinets,website,'.$cabinet->nrc_cab.',nrc_cab',
                'commentaire' => 'max:900'
            ]);

            $cabinet -> update($request->all());
            $request->session()->flash('updated', 'Modifié avec succès');

            $count_interv = Intervenant::where('nrc_c', '=', $request->input('nrc_cab'))->count();
            if ($count_interv == 0) {
                $request->session()->flash('warning', 'Veuillez associer des intervenants au cabinet ajouté !');
            }

        return redirect('/detail-cab/'.$nrc_c)->with('success');
        }
        else {
            //clean session keys
            // $request->session()->forget(['added', 'deleted', 'success', 'info', 'warning', 'error']);

            $cabinet = Cabinet::findOrFail($nrc_c);

        return view('cabinet.edit', ['cabinet'=>$cabinet]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $nrc_c)
    {
        //clean session keys
        // $request->session()->forget(['added', 'updated', 'success', 'info', 'warning', 'error']);

        $cabinet = Cabinet::findOrFail($nrc_c);
        $cabinet -> delete();

        $request->session()->flash('deleted', 'Supprimé avec succès');

    return redirect('/cabinet');
    }


    // public function pdfcabinet($nrc_cab)
    // {
    //     $cabinet = Cabinet::find($nrc_cab);
    //     $pdf = PDF::loadView('cabinet.pdfcabinet', ['cabinet' => $cabinet]);

    //     $namef= $cabinet->raisoci;

    //     return $pdf->stream($namef . ".pdf");
    // }

}
