<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\ClientsImport;
use Illuminate\Http\Request;
use Excel;

class ImportClientController extends Controller
{
    function index() {
      return view('client.import');
    }

    //IMPORT EXCEL FILE FUCNTION
    function import(Request $request) {

      $this->validate($request, ['client_file' => 'required|file|mimes:xls,xlsx']);

      $file = $request->file('client_file');
      $filename = $file->getClientOriginalName().'-'.time().".". $file->getClientOriginalExtension();
      $path = 'files/clients/';
      $file->move($path, $filename);
      $file_url = $path . $filename;


      $import_client = new ClientsImport();
      $import_client->onlySheets('clients'); // spécifier la feuille excel qui contient les doccées du client

      Excel::import($import_client, $file_url);

      $request->session()->flash('added', 'Le fichier à été importé avec succès!');

      return redirect('/import-client')->with('success');
    } //import fun
}
