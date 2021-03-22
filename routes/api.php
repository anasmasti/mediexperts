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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  // Route::get('/fill-clients', 'FormulaireController@FillClients')->name('M1.print_m1');
<<<<<<< HEAD
=======

>>>>>>> d996ee2e7753e55c76bfabe8b80e72426b1351d8
});
