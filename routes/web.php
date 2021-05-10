<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\FormulaireController;


Auth::routes(['verify' => true]);

// Route::group(['middleware' => ['auth', 'admin']], function() { //begin */


Route::group(['middleware' => ['verified']], function() {

Route::get('/client', 'ClientController@index')->name('client.index');
Route::get('/detail-cl/{nrc}', 'ClientController@show')->name('client.show');

Route::get('/add-cl', 'ClientController@store')->name('client.store');
Route::post('/add-cl', 'ClientController@store')->name('client.store');

Route::get('/edit-cl/{nrc}', 'ClientController@update')->name('client.update');
Route::post('/edit-cl/{nrc}', 'ClientController@update')->name('client.update');
Route::get('/searchclient', 'ClientController@searchclient');
Route::get('/del-cl/{nrc}', 'ClientController@destroy')->name('client.destroy');

//*************** USER ROUTES ***************
Route::get('/users', 'HomeController@index')->name('users.index');
// Route::get('/', 'HomeController@index')->name('home.dashboard');
/*--------------------------------------------------------------*/

Route::get('/logout','\App\Http\Controllers\Auth\LoginController@logout');

//*************** ADMIN ROUTES ***************
Route::get('/', 'AdminController@index')->name('dashboard');
Route::get('/home', 'AdminController@index')->name('home.dashboard');
Route::get('/users', 'HomeController@index')->name('users.index');
Route::get('/del-user/{id}', 'HomeController@destroy')->name('users.index');

/*--------------------------------------------------------------*/


//*************** CLIENT ROUTES ***************
Route::get('/client', 'ClientController@index')->name('client.index');
Route::get('/detail-cl/{nrc}', 'ClientController@show')->name('client.show');

Route::get('/add-cl', 'ClientController@store')->name('client.store');
Route::post('/add-cl', 'ClientController@store')->name('client.store');

Route::get('/edit-cl/{nrc}', 'ClientController@update')->name('client.update');
Route::post('/edit-cl/{nrc}', 'ClientController@update')->name('client.update');
Route::get('/searchclient', 'ClientController@searchclient');
Route::get('/del-cl/{nrc}', 'ClientController@destroy')->name('client.destroy');

Route::get('/import-client', 'Import\ImportClientController@index')->name('client.index-import');
Route::post('/import/import-client', 'Import\ImportClientController@import')->name('client.import');
/********************************************************************/


//*************** CABINET ROUTES ***************
Route::get('/cabinet', 'CabinetController@index')->name('cabinet.index');
Route::get('/detail-cab/{nrc}', 'CabinetController@show')->name('cabinet.show');

Route::get('/add-cab', 'CabinetController@store')->name('cabinet.store');
Route::post('/add-cab', 'CabinetController@store')->name('cabinet.store');

Route::get('/edit-cab/{nrc}', 'CabinetController@update')->name('cabinet.update');
Route::post('/edit-cab/{nrc}', 'CabinetController@update')->name('cabinet.update');

Route::get('/del-cab/{nrc}', 'CabinetController@destroy')->name('cabinet.destroy');
Route::get('/searchcabinet', 'CabinetController@searchcabinet');

Route::get('cabinet/pdfcabinet/{nrc_cab}', 'CabinetController@pdfcabinet');
/********************************************************************/


//*************** GIAC ROUTES ***************
Route::get('/giac', 'GiacController@index')->name('giac.index');
Route::get('/detail-gc/{code}', 'GiacController@show')->name('giac.show');

Route::get('/add-gc', 'GiacController@store')->name('giac.store.get');
Route::post('/add-gc', 'GiacController@store')->name('giac.store.post');

Route::get('/edit-gc/{code}', 'GiacController@update')->name('giac.update.get');
Route::post('/edit-gc/{code}', 'GiacController@update')->name('giac.update.post');
Route::get('/searchgiac', 'GiacController@searchgiac');
Route::get('/del-gc/{code}', 'GiacController@destroy')->name('giac.destroy');
/********************************************************************/


//*************** ACTIONNAIRE ROUTES ***************
Route::get('/actionnaire', 'ActionnaireController@index')->name('actionnaire.index');
Route::get('/detail-act/{id}/{nrc}', 'ActionnaireController@show')->name('actionnaire.show');

Route::get('/add-act', 'ActionnaireController@store')->name('actionnaire.store');
Route::post('/add-act', 'ActionnaireController@store')->name('actionnaire.store');

Route::get('/edit-act/{id}/{nrc}', 'ActionnaireController@update')->name('actionnaire.update');
Route::post('/edit-act/{id}/{nrc}', 'ActionnaireController@update')->name('actionnaire.update');


Route::get('/searchact', 'ActionnaireController@searchact');

Route::get('/del-act/{id}', 'ActionnaireController@destroy')->name('actionnaire.destroy');
/********************************************************************/


//*************** INTERVENANT ROUTES ***************
Route::get('/intervenant', 'IntervenantController@index')->name('intervenant.index');
Route::get('/detail-inv/{id}', 'IntervenantController@show')->name('intervenant.show');

Route::get('/add-inv', 'IntervenantController@store')->name('intervenant.store');
Route::post('/add-inv', 'IntervenantController@store')->name('intervenant.store');

Route::get('/edit-inv/{id}', 'IntervenantController@update')->name('intervenant.update');
Route::post('/edit-inv/{id}', 'IntervenantController@update')->name('intervenant.update');


Route::get('/searchinter', 'IntervenantController@searchinter');

Route::get('/del-inv/{id}', 'IntervenantController@destroy')->name('intervenant.destroy');
/********************************************************************/


//*************** DEMANDE FINANCEMENT ROUTES ***************
Route::get('/df', 'DemandeFinancementController@index')->name('DF.index');
Route::get('/detail-df/{ndf}', 'DemandeFinancementController@show')->name('DF.show');

Route::get('/add-df', 'DemandeFinancementController@store')->name('DF.store');
Route::post('/add-df', 'DemandeFinancementController@store')->name('DF.store');

Route::get('/edit-df/{ndf}', 'DemandeFinancementController@update')->name('DF.update');
Route::post('/edit-df/{ndf}', 'DemandeFinancementController@update')->name('DF.update');

Route::get('/del-df/{ndf}', 'DemandeFinancementController@destroy')->name('DF.destroy');

Route::get('/findgiacsclient', 'DemandeFinancementController@FindGiacsClient'); //find giac of client

Route::get('/searchdf', 'DemandeFinancementController@searchdf');
Route::get('/drb-df-gc/{ndf}', 'DemandeFinancementController@DemandeGiac_DF')->name('DF.DemandeGiac_DF');
/********************************************************************/


//*************** GIAC DR ROUTES ***************
Route::get('/drb-gc', 'DemandeRemboursementGiacController@index')->name('DRB_Giac.index');
Route::get('/detail-drb-gc/{ndrb}', 'DemandeRemboursementGiacController@show')->name('DRB_Giac.show');

Route::get('/add-drb-gc', 'DemandeRemboursementGiacController@store')->name('DRB_Giac.store');
Route::post('/add-drb-gc', 'DemandeRemboursementGiacController@store')->name('DRB_Giac.store');

Route::get('/edit-drb-gc/{ndrb}', 'DemandeRemboursementGiacController@update')->name('DRB_Giac.update');
Route::post('/edit-drb-gc/{ndrb}', 'DemandeRemboursementGiacController@update')->name('DRB_Giac.update');

Route::get('/searchdrb', 'DemandeRemboursementGiacController@searchdrb');

Route::get('/del-drb-gc/{ndrb}', 'DemandeRemboursementGiacController@destroy')->name('DRB_Giac.destroy');

Route::get('/print-facture-drb/{ndrb}/{nrc}', 'DemandeRemboursementGiacController@FactureDrbGiac')->name('DRB_GIAC.FactureDrbGiac');
Route::post('/save-nfacture-giac', 'DemandeRemboursementGiacController@SaveNFactureGiac')->name('DRB_GIAC.SaveNFactureGiac');

Route::get('/print-facture-df/{nrc}', 'DemandeFinancementController@FactureDF')->name('DF.FactureDF');
Route::post('/save-nfacture-df', 'DemandeFinancementController@SaveNFactureDF')->name('DF.SaveNFactureDF');
/********************************************************************/


//***************  OFPPT DR ROUTES ***************
Route::get('/drb-of', 'DemandeRemboursementOfpptController@index')->name('DRB_Ofppt.index');
Route::get('/list-drb', 'Testcontroller2@index')->name('DRB_Ofppt.index');
// Route::get('/detail-drb-of/{ndrb}', 'DemandeRemboursementOfpptController@show')->name('DRB_Ofppt.show');
Route::get('/detail-drb-of', 'DetailCntroller@detail')->name('DRB_Ofppt.show');

Route::get('/add-drb-of', 'DemandeRemboursementOfpptController@store')->name('DRB_Ofppt.store');
Route::post('/add-drb-of', 'DemandeRemboursementOfpptController@store')->name('DRB_Ofppt.store');

Route::get('/edit-drb-of/{ndrb}', 'DemandeRemboursementOfpptController@update')->name('DRB_Ofppt.update');
Route::post('/edit-drb-of/{ndrb}', 'DemandeRemboursementOfpptController@update')->name('DRB_Ofppt.update');
Route::get('/edit-drb', 'EditController@update')->name('DRB_Ofppt.update');


Route::get('/searchofppt', 'DemandeRemboursementOfpptController@searchofppt');

Route::get('/del-drb-of/{ndrb}', 'DemandeRemboursementOfpptController@destroy')->name('DRB_Ofppt.destroy');
/********************************************************************/


//*************** PLAN FORMATION ROUTES ***************
Route::get('/plan', 'PlanController@index')->name('PLAN.index');
Route::get('/detail-plan/{id_plan}', 'PlanController@show')->name('PLAN.show');

Route::get('/add-plan', 'PlanController@store')->name('PLAN.store');
Route::post('/add-plan', 'PlanController@store')->name('PLAN.store');

Route::get('/edit-plan/{id_plan}', 'PlanController@update')->name('PLAN.update');
Route::post('edit-plan/{id_plan}', 'PlanController@update');

Route::get('/search-pdf', 'PlanController@searchplan');

Route::get('/del-plan/{id_plan}', 'PlanController@destroy')->name('PLAN.destroy');
/********************************************************************/


//*************** ACTION FORMATION ROUTES ***************
Route::get('/PlanFormation', 'PlanFormationController@index')->name('PF.index');
Route::get('/act-form-cl/{nrc}/{annee}', 'PlanFormationController@ActionFormationClient')->name('PF.ActionFormationClient');
Route::get('/detail-pf/{nf}', 'PlanFormationController@show')->name('PF.show');

Route::get('/add-pf', 'PlanFormationController@store')->name('PF.store');
Route::post('/add-pf', 'PlanFormationController@store')->name('PF.store');

Route::get('/edit-pf/{nf}', 'PlanFormationController@update')->name('PF.update');
Route::post('/edit-pf/{nf}', 'PlanFormationController@update')->name('PF.update');

Route::get('/searchplan', 'PlanFormationController@searchplan');

Route::get('/findthemesdomain', 'PlanFormationController@FindThemesDomain');
Route::get('/find-client-plan', 'PlanFormationController@FindClientPlan');
Route::get('/finddomaindependvilleclient', 'PlanFormationController@FindDomainDependVilleClient');
Route::get('/findorganismeinterv', 'PlanFormationController@FindOrganismeInterv');

Route::get('/del-pf/{nform}/{id_plan}', 'PlanFormationController@destroy')->name('PF.destroy');
Route::get('/avis-modif','PlanFormationController@avismodif')->name('av.modification');
Route::get('/avis-modif','PlanFormationController@print_avismodif')->name('print.avismodif');


/********************************************************************/


//*************** FORMATION ROUTES ***************
Route::get('/formation', 'FormationController@index')->name('formation.index');
Route::get('/detail-form/{id_form}', 'FormationController@show')->name('formation.show');

Route::get('/add-form', 'FormationController@store')->name('formation.store');
Route::post('/add-form', 'FormationController@store')->name('formation.store');

Route::get('/edit-form/{id_form}', 'FormationController@update')->name('formation.update');
Route::post('/edit-form/{id_form}', 'FormationController@update')->name('formation.update');

Route::get('/search-form', 'FormationController@search_form');

Route::get('/findnbjours', 'FormationController@FindNbJours');
Route::get('/finddates', 'FormationController@FindDates');
Route::get('/findplanformationprops', 'FormationController@FindPlanFormationProps');
Route::get('/findpersonnel', 'FormationController@FindPersonnel');
Route::get('/findpersonnelformation', 'FormationController@FindPersonnelFormation');
Route::post('/save-nfacture', 'FormationController@SaveNFacture');
Route::get('/verify-groupe', 'FormationController@VerifyGroupe');
Route::get('/detail-action-formation/{nForm}', 'FormationController@DetailActionFormation');
Route::get('/find-personnel-formation-deja', 'FormationController@FindPersonnelFormationDeja');

Route::get('/del-form/{id_form}', 'FormationController@destroy')->name('formation.destroy');
/********************************************************************/


//*************** MISSION INTERVENANT ROUTES ***************
Route::get('/mis-inv', 'MissionIntervenantController@index')->name('mission_interv.index');
Route::get('/detail-mis-inv/{id}/{idi}/{ndf}', 'MissionIntervenantController@show')->name('mission_interv.show');

Route::get('/add-mis-inv', 'MissionIntervenantController@store')->name('mission_interv.store');
Route::post('/add-mis-inv', 'MissionIntervenantController@store')->name('mission_interv.store');

Route::get('/edit-mis-inv/{id}/{idi}/{ndf}', 'MissionIntervenantController@update')->name('mission_interv.update');
Route::post('/edit-mis-inv/{id}/{idi}/{ndf}', 'MissionIntervenantController@update')->name('mission_interv.update');


Route::get('/searchmiss', 'MissionIntervenantController@searchmiss');

Route::get('/del-mis-inv/{id}', 'MissionIntervenantController@destroy')->name('mission_interv.destroy');
/********************************************************************/


//*************** DOMAINES ROUTES ***************
Route::get('/domain', 'DomaineController@index')->name('domain.index');
Route::get('/detail-domain/{id_domain}', 'DomaineController@show')->name('domain.show');

Route::get('/add-domain', 'DomaineController@store')->name('domain.store');
Route::post('/add-domain', 'DomaineController@store')->name('domain.store');

Route::get('/edit-domain/{id_domain}', 'DomaineController@update')->name('domain.update');
Route::post('/edit-domain/{id_domain}', 'DomaineController@update')->name('domain.update');


Route::get('/search-domain', 'DomaineController@search');

Route::get('/del-domain/{id_domain}', 'DomaineController@destroy')->name('domain.destroy');

Route::get('/themes-domain/{id_domain}', 'DomaineController@ShowThemesDomaine')->name('domain.ShowThemesDomaine');
/********************************************************************/


//*************** THEMES ROUTES ***************
Route::get('/theme', 'ThemeController@index')->name('theme.index');
Route::get('/detail-theme/{id_theme}', 'ThemeController@show')->name('theme.show');

Route::get('/add-theme', 'ThemeController@store')->name('theme.store');
Route::post('/add-theme', 'ThemeController@store')->name('theme.store');

Route::get('/edit-theme/{id_theme}', 'ThemeController@update')->name('theme.update');
Route::post('/edit-theme/{id_theme}', 'ThemeController@update')->name('theme.update');


Route::get('/search-theme', 'ThemeController@search');

Route::get('/del-theme/{id_theme}', 'ThemeController@destroy')->name('theme.destroy');
/********************************************************************/



//*************** PERSONNEL ROUTES ***************
Route::get('/import', 'ImportPersonnelController@index')->name('personnel.index-import');
Route::post('/import/import-pers', 'ImportPersonnelController@import')->name('personnel.import');

Route::get('/personnel', 'PersonnelController@index')->name('personnel.index');
Route::get('/detail-pers/{cin}', 'PersonnelController@show')->name('personnel.show');

Route::get('/add-pers', 'PersonnelController@store')->name('personnel.store');
Route::post('/add-pers', 'PersonnelController@store')->name('personnel.store');

Route::get('/edit-pers/{cin}', 'PersonnelController@update')->name('personnel.update');
Route::post('/edit-pers/{cin}', 'PersonnelController@update')->name('personnel.update');

Route::get('/personnel/search', 'PersonnelController@searchPersonnel');

Route::get('/del-pers/{cin}', 'PersonnelController@destroy')->name('personnel.destroy');
Route::delete('/del-mult-pers', 'PersonnelController@deleteMultiple')->name('personnel.deleteMultiple');
/********************************************************************/



//*************** FORMULAIRES ***************
Route::get('/print-f1/{nrc}', 'FormulaireController@print_f1')->name('personnel.print_f1');
Route::get('/index-f1/{nrc}', 'FormulaireController@index_f1')->name('personnel.index_f1');
// Route::get('/download-f1/{nrc}', 'FormulaireController@download_f1')->name('personnel.download_f1');

Route::get('/print-f2', 'FormulaireController@index_f2')->name('personnel.index_f2');

Route::get('/print-f3/{nrc}', 'FormulaireController@print_f3')->name('F3.print_f3');

Route::get('/print-m1', 'FormulaireController@print_m1')->name('M1.print_m1');
Route::get('/print-m3', 'FormulaireController@print_m3')->name('M3.print_m3');
Route::get('/print-g6' , 'FormulaireController@print_G6')->name('G6.print_G6');

Route::get('/fill-clients', 'FormulaireController@FillClients')->name('M1.print_m1');
Route::get('/fill-client-plans', 'FormulaireController@FillClientPlans')->name('M1.FillClientPlans');

Route::get('/print-m4/{idform}', 'FormulaireController@print_m4')->name('M4.print_m4');
Route::get('/index-m4/{idform}', 'FormulaireController@index_m4')->name('M4.index_m4');

Route::get('/print-f4', 'FormulaireController@print_f4')->name('F4.print_f4');
Route::get('/index-f4', 'FormulaireController@index_f4')->name('F4.index_f4');
Route::get('/fill-pf-f4', 'FormulaireController@FillPlanFormationF4')->name('F4.FillPlanFormationF4');
Route::get('/fill-form-f4', 'FormulaireController@FillFormationF4')->name('F4.FillFormationF4');
Route::get('/fill-personnel-f4', 'FormulaireController@FillPersonnelF4')->name('F4.FillPersonnelF4');
Route::get('/fill-person-info-f4', 'FormulaireController@FillPersonInfoF4')->name('F4.FillPersonInfoF4');

Route::get('/print-m5', 'FormulaireController@print_m5')->name('M5.print_m5');

Route::get('/print-f2', 'FormulaireController@print_f2')->name('F2.print_f2');
Route::get('/fill-form-f2', 'FormulaireController@FillFormationF2')->name('F2.FillFormationF2');
Route::get('/fill-form-info', 'FormulaireController@FillFormationInfo')->name('F2.FillFormationInfo');

Route::get('/fill-dates-plan', 'FormulaireController@FillDatesPlan')->name('plan_dates.FillDatesPlan');

Route::get('/print-pf', 'FormulaireController@print_pf')->name('plan_formations.print_pf');
Route::get('/fill-plans-by-reference', 'FormulaireController@FillPlansByReference')->name('plan_formations.FillPlansByReference');
Route::get('/fill-reference-plan', 'FormulaireController@FillReferencesPlan')->name('plan_formations.FillReferencesPlan');
Route::get('/fill-g6-info' , 'FormulaireController@FillG6Info');


Route::get('/print-m6', 'FormulaireController@print_m6')->name('M6.print_m6');
Route::get('/fill-plan-theme', 'FormulaireController@FillPlanTheme')->name('M6.FillPlanTheme');
Route::get('/fill-cabinet', 'FormulaireController@FillCabinet')->name('M6.FillCabinet');

Route::get('/print-fiche-evaluation', 'FormulaireController@print_fiche_evaluation')->name('Fiche_Evaluation.print_fiche_evaluation');
Route::get('/fill-fiche-evaluation', 'FormulaireController@FillFicheEval')->name('Fiche_Evaluation.FillFicheEval');
Route::get('/fill-dates-form', 'FormulaireController@FillDatesForm')->name('Fiche_Evaluation.FillDatesForm');

Route::get('/fill-action-form', 'FormulaireController@FillActionFormation')->name('PlanFormation.FillActionFormation');
Route::get('/print-avis-aff', 'FormulaireController@print_avis_aff')->name('PlanFormation.print_avis_aff');

Route::get('/print-att-reference-plan', 'FormulaireController@print_att_reference_plan')->name('PlanFormation.print_att_reference_plan');
Route::get('/fill-cabinet-info', 'FormulaireController@FillCabinetInfo')->name('PlanFormation.FillCabinetInfo');
Route::get('/fill-plan-by-client', 'FormulaireController@FillPlansByClient')->name('PlanByClinet');
Route::get('/fill-all-organisme' , 'FormulaireController@FillAllCabinets')->name('FillOrganisme');
Route::get('/fill-avis-modif' , 'FormulaireController@FillavisModif')->name('FillAvisModif');
Route::get('/fill-avis-modif-by-groupe' , 'FormulaireController@GetInfoAvisModifByGroupe');
Route::get('/old-avis-modif-by-theme', 'FormulaireController@GetOldInfoAvisModif');
Route::get('/get-nom-responsable-m3', 'FormulaireController@GetNomResponsableModel3');
Route::get('/get-nom-theme' , 'FormulaireController@GetNomTheme');
/********************************************************************/


//*************** FICHES DES MISSION ***************
Route::get('/print-att-reference-df-cab', 'FicheMissionController@print_att_reference_df_cab')->name('DF.print_att_reference_df_cab');
Route::get('/print-att-reference-df-inv', 'FicheMissionController@print_att_reference_df_inv')->name('DF.print_att_reference_df_inv');
Route::get('/fill-df-list', 'FicheMissionController@FillDFList')->name('DF.FillDFList');
Route::get('/find-df-info', 'FicheMissionController@FindDFInfo')->name('DF.FindDFInfo');
Route::get('/find-cab-info', 'FicheMissionController@FindCabinetInfo')->name('DF.FindCabinetInfo');
Route::get('/find-inv-info', 'FicheMissionController@FindIntervInfo')->name('DF.FindIntervInfo');
Route::get('/test' , 'PlanFormationController@Test')->name('Test');


}); //end middlware verified















