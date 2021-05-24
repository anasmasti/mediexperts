<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PersonnelsImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportPersonnelController extends Controller
{

    // public function customValidationMessages()
    // {
    //     return [
    //         'cin.unique' => 'le :attribut doit être unique',
    //     ];
    // }

    function index() {

        $data = DB::table('personnels')->orderBy('cin', 'DESC')->get();

        return view('personnel.import', compact('data'));
    }

    //IMPORT EXCEL FILE FUCNTION
    function import(Request $request) {

        $this->validate($request, ['pers_file' => 'required|file|mimes:xls,xlsx']);

        $file = $request->file('pers_file');
        $filename = $file->getClientOriginalName() . '-' . time() . "." . $file->getClientOriginalExtension();
        $path = 'files/';
        $file->move($path, $filename);
        $file_url = $path . $filename;

        Excel::import(new PersonnelsImport, $file_url);

        return redirect('/import')->with('success', 'les données sont importés avec succès');

    } //import fun


}
