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
Route::get('facilities','AdminController@facility');
Route::post('addfacility','AdminController@addfacility');
Route::get('facilityAdmin','AdminController@facilityAdmin');
Route::get('addAdmin','AdminController@create');
Route::post('adminstore','AdminController@store');

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
  Route::post('nurse.nutrition','NurseController@infantNutrition');
  Route::post('babydetails','NurseController@babyDetails');
  Route::post('motherdetails','NurseController@motherDetails');
  Route::post('allergies','NurseController@dependantAllergy');
  Route::post('vitaldetails','NurseController@vitalDetails');
  Route::post('disability','NurseController@patientDisability');
  Route::post('abnormalities','NurseController@abnormalities');
  Route::post('addfather','NurseController@addfather');
  Route::post('addmother','NurseController@addmother');
 Route::post('babytriage','NurseController@addBaby');
 Route::get('/tag/drugs', 'NurseController@fdrugs');
 Route::get('/tag/observation','NurseController@fobservation');
Route::get('/tag/symptom','NurseController@fsymptom');
Route::get('/tag/chief','NurseController@fchief');
Route::get('/ajax-subcat',function(){
	$cat_id= Input::get('cat_id');
	$symptoms= Symptom::where('observation_id','=',$cat_id)->get();

	return Response::json($symptoms);

});
});

// Doctor routes;
Route::group(['middleware' => ['auth','role:Admin|Doctor|Private']], function() {
Route::resource('doctor','DoctorController');
Route::get('doctorProfile', [ 'as' => 'doctorProfile', 'uses' => 'DoctorController@DocDetails']);
Route::get('appointment','DoctorController@Appointment');
Route::get('calendar','DoctorController@Calendar');
Route::resource('prescription', 'PrescriptionController@store');

Route::get('newpatients', [ 'as' => 'doctor', 'uses' => 'DoctorController@index']);
Route::get('patientadmitted', [ 'as' => 'admitted', 'uses' => 'DoctorController@Admitted']);
Route::get('testdone/{id}', [ 'as' => 'testdone', 'uses' => 'PatientController@testdone']);
Route::get('show/{id}',['as'=>'showPatient', 'uses'=>'PatientController@showpatient']);
Route::get('visit/{id}', [ 'as' => 'visit', 'uses' => 'PatientController@pvisit']);
Route::get('depvisit/{id}', [ 'as' => 'dependantvisit', 'uses' => 'PatientController@dependantvisit']);
Route::get('admit/{id}', [ 'as' => 'admit', 'uses' => 'PatientTestController@admit']);
Route::Post('admitts', [ 'as' => 'admitting', 'uses' => 'TagController@admitts']);
Route::get('transfer/{id}', [ 'as' => 'transfering', 'uses' => 'PatientTestController@transfer']);
Route::Post('transfers', [ 'as' => 'transfer', 'uses' => 'TagController@transfers']);
Route::get('endvisittransfer/{id}', [ 'as' => 'endvisit', 'uses' => 'TagController@endvisits']);

Route::get('/tags/tst', 'TagController@ftest');
Route::get('/docss/drugs', 'TestController@fdrugs');
Route::get('/disis/find', 'DiseasesController@find');
Route::get('/tags/fac', 'FacilityController@ffacility');


Route::Post('testpost', [ 'as' => 'patienttest', 'uses' => 'PatientTestController@store']);
Route::get('test/{id}', [ 'as' => 'testes', 'uses' => 'PatientTestController@testdata']);
Route::get('diagnosis/{id}', [ 'as' => 'diagnoses', 'uses' => 'PatientTestController@diagnoses']);
Route::Post('diagnosisconfirm', [ 'as' => 'diaconf', 'uses' => 'PatientTestController@diagnosesconf']);
Route::get('diagconfirm/{id}', [ 'as' => 'Testconfirms', 'uses' => 'PatientTestController@Testconfirm']);

Route::Post('diagnosis', [ 'as' => 'confdiag', 'uses' => 'PrescriptionController@diagnoses']);
Route::get('prescriptions/{id}', [ 'as' => 'medicines', 'uses' => 'PrescriptionController@prescriptions']);
Route::get('history/{id}', [ 'as' => 'patienthistory', 'uses' => 'PatientController@history']);

Route::get('disdiagnosis/{id}', [ 'as' => 'disdiagnosis', 'uses' => 'PatientTestController@disdiagnosis']);
Route::get('disprescription/{id}', [ 'as' => 'disprescription', 'uses' => 'PatientTestController@disprescription']);

Route::get('discharge/{id}', [ 'as' => 'discharge', 'uses' => 'PatientTestController@discharges']);
Route::Post('showdischarge', [ 'as' => 'discharging', 'uses' => 'TagController@discharge']);
});

Route::group(['middleware' => ['auth','role:Admin|Manufacturer']], function() {
Route::resource('manufacturer','ManufacturerController');
Route::get('DrugSubstitution','ManufacturerController@drugsubstitution');
Route::get('Drugsales','ManufacturerController@todaysales');
Route::get('druglist', 'ManufacturerController@show');
Route::get('manuemployees','ManufacturerController@getEmployees');
Route::post('addemployee','ManufacturerController@addEmployee');
Route::get('salesrep','ManufacturerController@getSalesrep');
Route::post('addsalesrep','ManufacturerController@addSalesrep');
Route::get('manudoctor', 'ManufacturerController@manuDoctor');
Route::get('region', 'ManufacturerController@Region');
Route::get('awaycompany', 'ManufacturerController@awayCompany');
Route::get('tocompany', 'ManufacturerController@toCompany');
Route::get('manustock', 'ManufacturerController@manuStock');
Route::get('competition', 'ManufacturerController@Competition');
Route::get('Trends','ManufacturerController@Trends');
Route::get('SectorSummary','ManufacturerController@SectorSummary');
Route::post('addmanu','ManufacturerController@addManu');
Route::get('manufacturerconfig','ManufacturerController@manconfig');
Route::get('/tags/drugs', 'TestController@fdrugs');
Route::post('adddrugs','ManufacturerController@adddrugs');
Route::post('addcompany','ManufacturerController@addcompany');

});

/**
* Pharmacy Routes
**/
Route::group(['middleware' => ['auth','role:Admin|Pharmacy']], function() {
Route::resource('pharmacy','PharmacyController');
Route::get('pharmacy/{id}', 'PharmacyController@show');
Route::post('post_presc', 'PharmacyController@postPresc');
Route::get('fill_prescription/{id}', [ 'as' => 'fillpresc', 'uses' => 'PharmacyController@fillPresc']);
Route::get('filled_prescriptions', ['as' => 'filled_prescriptions','uses' => 'PharmacyController@FilledPresc']);
Route::get('totalsales', 'PharmacyController@totalsales');
Route::get('available', 'PharmacyController@Available');
Route::get('analytics', 'PharmacyController@Analytics');
Route::get('/tag/drug', 'PharmacyController@fdrugs');
Route::get('/select2', 'PharmacyController@trySomething');
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'PharmacyController@autocomplete'));
Route::get('search/autocomplete', 'PharmacyController@autocomplete');
Route::get('inventory', [ 'as' => 'inventory', 'uses' => 'PharmacyController@showInventory']);
Route::get('new_stock', function()
{
	return view('pharmacy.new_stock');
}
);
Route::post('add_stock', ['as' => 'add_stock', 'uses' => 'PharmacyController@addStock']);
Route::get('/manus', 'PharmacyController@getManufacturer');
Route::get('edit_inventory/{id}', ['as' => 'edit_inventory', 'uses' => 'PharmacyController@getInventory']);
Route::post('submit_edited', ['as' => 'submit_edited', 'uses' => 'PharmacyController@editedInventory']);
Route::post('delete_inventory', ['as' => 'delete_inventory', 'uses' => 'PharmacyController@deleteInventory']);
Route::post('inventory_update', ['as' => 'inventory_update', 'uses' => 'PharmacyController@updateInventory']);
Route::get('update_inv/{id}', ['as' => 'update_inv', 'uses' => 'PharmacyController@getInventory2']);
});


Route::group(['middleware' => ['auth','role:Admin|Test|Doctor']], function() {
Route::resource('test','PatientTestController');
});
Route::group(['middleware' => ['auth','role:Admin|Patient']], function() {
	Route::resource('patient','PatientController');
	Route::get('PatientAllergies','PatientController@patientAllergies');
	Route::get('expenditure','PatientController@Expenditure');
	Route::get('patientdependants','PatientController@getDependant');

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
	Route::get('allpatients','RegistrarController@allPatients');
	Route::post('registeruser','RegistrarController@store');

    Route::get('registrar.selects/{id}','privateController@selectChoice');
    Route::get('registrar.shows/{id}','privateController@showUser');
    Route::post('privateconsultationfee','privateController@consultationFees');
    Route::get('registrar.showdependants/{id}','privateController@selectDependant');
    Route::post('privateDependentconsultationfee','privateController@Dependentconsultationfee');

});
/**
* Test Routes
**/
Route::group(['middleware' => ['auth','role:Admin|Test']], function() {
	Route::resource('test','TestController');
	Route::get('testsales','TestController@testSales');
	Route::get('testanalytics','TestController@testAnalytics');
	Route::get('patientTests/{id}', [ 'as' => 'patientTests', 'uses' => 'TestController@testdetails']);

	Route::get('action/{id}', [ 'as' => 'perftest', 'uses' => 'TestController@actions']);
	Route::Post('pdetails', [ 'as' => 'testResult', 'uses' => 'TestController@testResult']);
	Route::Post('pdetails2', [ 'as' => 'testfilm', 'uses' => 'TestController@testResult']);


});

//FacilityAdmin

Route::group(['middleware' => ['auth','role:Admin|FacilityAdmin']], function() {
Route::resource('facilityadmin','FacilityAdminController');
Route::get('facilityregister','FacilityAdminController@facilityregister');
Route::get('facilitynurse','FacilityAdminController@facilitynurse');
Route::get('facilitydoctor','FacilityAdminController@facilitydoctor');
Route::get('facilityofficer','FacilityAdminController@facilityofficer');
Route::get('createdoc','FacilityAdminController@createdoc');
Route::get('/tags/doc','FacilityAdminController@finddoc');
Route::post('addfacilityregistrar','FacilityAdminController@store');
Route::post('addfacilitynurse','FacilityAdminController@storenurse');
Route::post('addfacilitydoctor','FacilityAdminController@storedoctor');
Route::Post('addfacilityofficer','FacilityAdminController@storeofficer');


});

//PrivateDoc

Route::group(['middleware' => ['auth','role:Private|Admin']], function() {
Route::resource('private','privateController');
Route::get('private.fees','privateController@Fees');
Route::get('private.show','privateController@show');
Route::get('nursevitals/{id}','privateController@nurseVitals');
Route::get('/tag1/drugs', 'privateController@fdrugs');
Route::get('/tag1/observation','privateController@fobservation');
Route::get('/tag1/symptom','privateController@fsymptom');
Route::get('/tag1/chief','privateController@fchief');
Route::post('private.createdetail','privateController@createDetails');


Route::get('privatepatients', [ 'as' => 'privatepat', 'uses' => 'privateController@privatepatient']);
Route::get('privateaddmited', [ 'as' => 'privadmpat', 'uses' => 'privateController@privadmitted']);

});
