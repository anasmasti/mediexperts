<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('store-avis-modif' , 'AvisModificationController@StoreUpdateAvisModif');

Route::post('update-drb-ofppt' , 'DemandeRemboursementOfpptController@update');
Route::post('delete-drb-ofppt' , 'DemandeRemboursementOfpptController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {

  // Route::get('/fill-clients', 'FormulaireController@FillClients')->name('M1.print_m1');

});
