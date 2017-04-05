<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
return view('welcome');
});



Route::get('steve', function () {
return view('nurse.infact_triage');
});

Route::auth();
Route::group(['middleware' => ['auth']], function() {

Route::get('/home', 'HomeController@index');
Route::resource('users','UserController');
});
// Route::resource('test','TestController@index');


Route::group(['middleware' => ['auth','role:Admin']], function() {
Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index']);
Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create']);
Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store']);
Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit']);

	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update']);
  Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy']);


});

Route::group(['middleware' => ['auth','role:Admin']], function() {
Route::resource('admin','AdminController');
Route::resource('kins','KinController');
Route::resource('facility','FacilityController');
Route::resource('county','CountyController');
Route::resource('constituency','ConstituencyController');
Route::resource('allergy','AllergyController');
Route::resource('illness','IllnessController');
Route::resource('diseases','DiseasesController');
Route::resource('chronic','ChronicController');
Route::resource('vaccine','VaccineController');

Route::get('config', function () {
return view('admin.config');
});
});
// Nurse routes;
Route::group(['middleware' => ['auth','role:Admin|Nurse']], function() {
	Route::resource('nurse','NurseController');
	Route::get('all_patients', 'NurseController@users');
	Route::get('waitingList', 'NurseController@wList');
	Route::get('nurseappointment','NurseController@Appointment');
	Route::get('calendarnurse','NurseController@Calendar');
    Route::get('nurse.patientshow/{id}','NurseController@patientShow');
	Route::get('nurse.createkin/{id}',['as'=>'createkin','uses'=>'NurseController@createnextkin']);
	Route::get('nurse.vaccine/{id}',['as'=>'vaccinescreate','uses'=>'NurseController@vaccinescreate']);
  Route::get('nurse.details/{id}',['as'=>'details','uses'=>'NurseController@details']);
  Route::get('infactdetails/{id}','NurseController@infactDetails');
	Route::post('nextkin','NurseController@nextkin');
	Route::post('updatekin','NurseController@Updatekin');
	Route::post('vaccine','NurseController@vaccine');
	Route::post('updateuser','NurseController@updateUser');
  Route::get('nurseupdate/{id}','NurseController@nurseUpdate');
	Route::post('nurseupdates','NurseController@nurseUpdates');
	Route::get('nurse.dependents/{id}','NurseController@showDependents');
  Route::post('nurse.show',['as'=>'createdetail','uses'=>'NurseController@createdetails']);
  Route::post('createinfantdetails','NurseController@createinfantDetails');
  Route::get('immuninationchart/{id}','NurseController@immuninationChart');
  Route::get('growth/{id}','NurseController@childGrowth');
  Route::get('update.dependant/{id}','NurseController@updateDependant');
  Route::post('Dependantupdate','NurseController@Dependantupdate');
  Route::get('showpatient/{id}','NurseController@shoWpatient');
  Route::get('immunination/{id}','NurseController@immunination');
  Route::post('immunization','NurseController@storeImmunization');
  Route::post('updateinfant','NurseController@updateInfant');

Route::get('/ajax-subcat',function(){
	$cat_id= Input::get('cat_id');
	$symptoms= Symptom::where('observation_id','=',$cat_id)->get();

	return Response::json($symptoms);

});
});

// Doctor routes;
  Route::group(['middleware' => ['auth','role:Admin|Doctor']], function() {
	Route::resource('doctor','DoctorController');
	Route::get('doctorProfile', [ 'as' => 'doctorProfile', 'uses' => 'DoctorController@DocDetails']);
  Route::get('appointment','DoctorController@Appointment');
	Route::get('calendar','DoctorController@Calendar');
	Route::resource('prescription', 'PrescriptionController@store');

   Route::Post('show', [ 'as' => 'patienttest', 'uses' => 'PatientTestController@store']);
   Route::get('testdone/{id}', [ 'as' => 'testdone', 'uses' => 'PatientController@testdone']);
	 Route::get('showhistory/{id}',['as'=>'showhistory', 'uses'=>'PatientController@showhistory']);
   Route::get('show/{id}',['as'=>'showPatient', 'uses'=>'PatientController@showpatient']);
   Route::get('visit/{id}', [ 'as' => 'visit', 'uses' => 'PatientController@pvisit']);
	 Route::Post('showpatient', [ 'as' => 'patientnotes', 'uses' => 'PatientController@PatientNotes']);
	 Route::get('/tags/find', 'TagController@find');
	 Route::get('/tags/tst', 'TagController@ftest');
	 Route::get('/tags/drugs', 'TestController@fdrugs');
   Route::get('/disis/find', 'DiseasesController@find');
	 Route::get('/tags/fac', 'FacilityController@ffacility');

  Route::get('motherdetails1', [ 'as' => 'mom1', 'uses' => 'InfantController@MDetails1']);
	Route::get('motherdetails2', [ 'as' => 'mom2', 'uses' => 'InfantController@MDetails2']);



Route::get('testresult/{id}','ShowController@index');
Route::post('testresult','ShowController@store');
});

Route::group(['middleware' => ['auth','role:Admin|Manufacturer']], function() {
Route::resource('manufacturer','ManufacturerController');
Route::get('druglist', 'ManufacturerController@show');
Route::get('manudrug', 'ManufacturerController@manuDrug');
Route::get('manudoctor', 'ManufacturerController@manuDoctor');
Route::get('region', 'ManufacturerController@Region');
Route::get('awaycompany', 'ManufacturerController@awayCompany');
Route::get('tocompany', 'ManufacturerController@toCompany');
Route::get('manustock', 'ManufacturerController@manuStock');
Route::get('competition', 'ManufacturerController@Competition');


});

/**
* Pharmacy Routes
**/
Route::group(['middleware' => ['auth','role:Admin|Pharmacy']], function() {
Route::resource('pharmacy','PharmacyController');
Route::get('pharmacy/{id}', 'PharmacyController@show');
Route::get('totalsales', 'PharmacyController@totalsales');
Route::get('available', 'PharmacyController@Available');
Route::get('analytics', 'PharmacyController@Analytics');


});



Route::group(['middleware' => ['auth','role:Admin|Test|Doctor']], function() {
Route::resource('test','PatientTestController');
});
Route::group(['middleware' => ['auth','role:Admin|Patient']], function() {
	Route::resource('patient','PatientController');
	Route::get('PatientAllergies','PatientController@patientAllergies');
	Route::get('expenditure','PatientController@Expenditure');

	Route::get('patientappointment','PatientController@patientAppointment');
	Route::get('patientcalendar','PatientController@patientCalendar');
});
Route::group(['middleware' => ['auth','role:Admin|Registrar']], function() {
	Route::resource('registrar','RegistrarController');
	Route::get('registrar.show/{id}','RegistrarController@showUser');
	Route::get('registrar.select/{id}','RegistrarController@selectChoice');
	Route::get('registrar.addDependents/{id}','RegistrarController@addDependents');
	Route::get('registrar.dependant/{id}','RegistrarController@selectDependant');
	Route::post('updateusers','RegistrarController@updateUsers');
	Route::post('registrarnextkin','RegistrarController@registrarNextkin');
	Route::get('update/{id}','RegistrarController@updateKin');
	Route::post('registrarupdatekin','RegistrarController@registrarUpdatekin');
	Route::get('consultationfee/{id}','RegistrarController@consultationFee');
	Route::post('consultationfee','RegistrarController@consultationFees');
	Route::get('fees','RegistrarController@Fees');
	Route::post('createdependent','RegistrarController@createDependent');
	Route::get('registrar.dependantTriage/{id}','RegistrarController@dependantTriage');
	Route::post('Dependentconsultationfee','RegistrarController@Dependentconsultationfee');


});
/**
* Test Routes
**/
Route::group(['middleware' => ['auth','role:Admin|Test']], function() {
	Route::resource('test','TestController');
	Route::get('testsales','TestController@testSales');
	Route::get('testanalytics','TestController@testAnalytics');
	Route::get('patientTests/{id}', [ 'as' => 'patientTest', 'uses' => 'TestController@testdetails']);
	// Route::get('testing/{id} ', [ 'as' => 'testing', 'uses' => 'TestController@testing']);
  Route::Post('pdetails', [ 'as' => 'testResult', 'uses' => 'TestController@testResult']);


});
