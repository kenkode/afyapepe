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

//android routes

Route::get('getallpatients', 'AndroidController@getAllPatients');
Route::post('getpatients', 'AndroidController@getPatients');
Route::get('getwaitinglist', 'AndroidController@getWaitingList');
Route::post('showpatientdetails', 'AndroidController@showPatientDetails');
Route::post('getcount', 'AndroidController@getCount');

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
Route::get('addtest','AdminController@addtest');
Route::post('addingtest','AdminController@storetest');
Route::get('testupdate/{id}', [ 'as' => 'teststo', 'uses' => 'AdminController@teststo']);
Route::delete('testts/{id}',['as'=>'testts.destroy','uses'=>'AdminController@destroytests']);


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
  Route::get('showpatient/{id}','NurseController@showpatient');
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
Route::get('/tag/chronic','NurseController@fchronic');
Route::get('nurse.existapp/{id}','NurseController@existingapp');
Route::post('createexistingdetail','NurseController@createexistingdetail');
Route::get('nurse.deexistapp/{id}','NurseController@deexistapp');
Route::post('existingdetail','NurseController@existingdetail');
Route::get('/tag/constituencyr','NurseController@findConstituencyr');
Route::get('add_allergy/{id}','NurseController@add_allergy');
Route::post('update_allergy','NurseController@update_allergy');
Route::get('nurse.preview/{id}','NurseController@preview');
Route::post('update_preview','NurseController@update_preview');
Route::get('nurse.dep_preview/{id}','NurseController@dep_preview');
Route::post('update_dep_preview','NurseController@update_dep_preview');
Route::get('add_chronic/{id}','NurseController@add_chronic');
Route::post('update_chronic','NurseController@updatechronic');

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
Route::get('calendar','DoctorController@Calendar');
Route::resource('prescription', 'PrescriptionController@store');

Route::get('newpatients', [ 'as' => 'doctor', 'uses' => 'DoctorController@index']);
Route::get('pendingpatients', [ 'as' => 'pending', 'uses' => 'DoctorController@pending']);
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

Route::delete('testremove/{id}',['as'=>'test.deletes','uses'=>'PatientTestController@destroytest']);
Route::Post('testpost', [ 'as' => 'testsave', 'uses' => 'TestsaveController@store']);
Route::Post('Radiology', [ 'as' => 'Radtest', 'uses' => 'RadiologyController@store']);
Route::delete('Radyremove/{id}',['as'=>'Rady.deletes','uses'=>'RadiologyController@destroytest']);
Route::get('test/{id}', [ 'as' => 'testes', 'uses' => 'PatientTestController@testdata']);
Route::get('diagnosis/{id}', [ 'as' => 'diagnoses', 'uses' => 'PatientTestController@diagnoses']);
Route::Post('diagnosisconfirm', [ 'as' => 'diaconf', 'uses' => 'PatientTestController@diagnosesconf']);
Route::Post('diagconfirm', [ 'as' => 'Testconfirms', 'uses' => 'PatientTestController@Testconfirm']);

Route::Post('ctReport', [ 'as' => 'ctreport', 'uses' => 'PatientTestController2@ctreports']);
Route::Post('mriReport', [ 'as' => 'mrireport', 'uses' => 'PatientTestController2@mrireports']);
Route::Post('ultraReport', [ 'as' => 'ultrareport', 'uses' => 'PatientTestController2@ultrareports']);
Route::Post('xrayReport', [ 'as' => 'xrayreport', 'uses' => 'PatientTestController2@xrayreports']);



Route::Post('diagnosis', [ 'as' => 'confdiag', 'uses' => 'PrescriptionController@diagnoses']);
Route::get('prescriptions/{id}', [ 'as' => 'medicines', 'uses' => 'PrescriptionController@prescriptions']);
Route::get('history/{id}', [ 'as' => 'patienthistory', 'uses' => 'PatientController@history']);
Route::delete('prescremove/{id}',['as'=>'prescs.deletes','uses'=>'PrescriptionController@destroypresc']);

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
Route::group(['middleware' => ['auth','role:Admin|Pharmacyadmin|Pharmacymanager']], function() {
Route::resource('pharmacy','PharmacyController');
Route::get('pharmacy/{id}', 'PharmacyController@show');
Route::get('home',[ 'as' => 'home', 'uses' => 'PharmacyController@index']);
Route::post('post_presc', 'PharmacyController@postPresc');
Route::get('fill_prescription/{id}', [ 'as' => 'fillpresc', 'uses' => 'PharmacyController@fillPresc']);
Route::get('substitution/{id}', [ 'as' => 'substitution', 'uses' => 'PharmacyController@subPresc']);
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

Route::post('submit_edited', ['as' => 'submit_edited', 'uses' => 'PharmacyController@editedInventory']);
Route::post('delete_inventory', ['as' => 'delete_inventory', 'uses' => 'PharmacyController@deleteInventory']);
Route::get('inventory_report', ['as' => 'inventory_report', 'uses' => 'PharmacyController@inventoryReport']);
Route::get('/supplier', 'PharmacyController@fetchSuppliers');
});

/**
*Routes for pharmacy,manager and store keeper
*/
Route::group(['middleware' => ['auth','role:Admin|Pharmacyadmin|Pharmacymanager|Pharmacystorekeeper']], function() {
Route::post('edit_inventory', ['as' => 'edit_inventory', 'uses' => 'PharmacyController@getInventory']);
Route::get('inventory', [ 'as' => 'inventory', 'uses' => 'PharmacyController@showInventory']);
Route::post('inventory_update', ['as' => 'inventory_update', 'uses' => 'PharmacyController@updateInventory']);
Route::get('update_inv/{id}', ['as' => 'update_inv', 'uses' => 'PharmacyController@getInventory2']);

Route::get('receipts.pharmacy/{id}','PharmacyController@receipts');

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
	Route::get('receipts.patient/{id}','PatientController@receipts');
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
	Route::get('/tag/constituency','RegistrarController@findConstituency');

    Route::get('registrar.selects/{id}','privateController@selectChoice');
    Route::get('registrar.shows/{id}','privateController@showUser');
    Route::post('privateconsultationfee','privateController@consultationFees');
    Route::get('registrar.showdependants/{id}','privateController@selectDependant');
    Route::post('privateDependentconsultationfee','privateController@Dependentconsultationfee');

    Route::get('register_edit_nextkin/{id}','RegistrarController@edit_nextkin');
    Route::post('register_update_nextkin','RegistrarController@update_nextkin');
    Route::get('register_edit_patient/{id}','RegistrarController@edit_patient');
    Route::post('register_update_patient','RegistrarController@update_patient');
    Route::get('receipts.consultationfees/{id}','RegistrarController@receiptsFees');


});
/**
* Test Routes
**/
Route::group(['middleware' => ['auth','role:Admin|Test']], function() {
	Route::resource('test','TestController');
	Route::get('testsales','TestController@testSales');
	Route::get('testanalytics','TestController@testAnalytics');
	Route::get('patientTests/{id}', [ 'as' => 'patientTests', 'uses' => 'TestController@testdetails']);
	Route::get('radTests/{id}', [ 'as' => 'pradTests', 'uses' => 'TestController@radydetails']);
	Route::get('action/{id}', [ 'as' => 'perftest', 'uses' => 'TestController@actions']);

	Route::get('radiologyp/{id}', [ 'as' => 'perftestradio', 'uses' => 'TestController@actionxray']);
	Route::get('radiomri/{id}', [ 'as' => 'perftestmri', 'uses' => 'TestController@actionmri']);
	Route::get('radioultra/{id}', [ 'as' => 'perftestultra', 'uses' => 'TestController@actionultra']);
	Route::get('radioct/{id}', [ 'as' => 'perftestct', 'uses' => 'TestController@actionct']);

	Route::Post('pdetails', [ 'as' => 'testResult', 'uses' => 'TestController@testResult']);
	Route::Post('pdetails3', [ 'as' => 'testResult3', 'uses' => 'TestController@testResult3']);
	Route::Post('pdetails4', [ 'as' => 'testResult4', 'uses' => 'TestController@testResult4']);
	Route::Post('pdetails5', [ 'as' => 'testResult5', 'uses' => 'TestController@testResult5']);
	Route::Post('pdetailsctest', [ 'as' => 'ctest', 'uses' => 'TestController@ctest']);

	Route::Post('xrayreport', [ 'as' => 'xrayfindings', 'uses' => 'TestController2@xrayfindings']);
	Route::Post('ctreport', [ 'as' => 'ctfindings', 'uses' => 'TestController2@ctfindings']);
	Route::Post('mrireport', [ 'as' => 'mrifindings', 'uses' => 'TestController2@mrifindings']);
	Route::Post('ultrareport', [ 'as' => 'ultrafindings', 'uses' => 'TestController2@ultrafindings']);

	Route::Post('xrayreport2', [ 'as' => 'xrayreports', 'uses' => 'TestController2@xrayreports']);
	Route::Post('ctreport2', [ 'as' => 'ctreports', 'uses' => 'TestController2@ctreports']);
	Route::Post('mrireport2', [ 'as' => 'mrireports', 'uses' => 'TestController2@mrireports']);
	Route::Post('ultrareport2', [ 'as' => 'ultrareports', 'uses' => 'TestController2@ultrareports']);


Route::Post('pdetails2', [ 'as' => 'testfilm', 'uses' => 'TestController@testreport']);
Route::Post('report', [ 'as' => 'testRupdt', 'uses' => 'TestController@testupdate']);

Route::get('grapher/{id}', [ 'as' => 'grapherxray', 'uses' => 'TestController@grapherxray']);
Route::get('graphermr/{id}', [ 'as' => 'graphermri', 'uses' => 'TestController@graphermri']);
Route::get('grapherct/{id}', [ 'as' => 'grapherct', 'uses' => 'TestController@grapherct']);
Route::get('grapherultra/{id}', [ 'as' => 'grapherultra', 'uses' => 'TestController@grapherultra']);
Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'TestController2@fileUpload']);
Route::post('fileUploads','TestController2@fileUploads');
Route::post('fileUploade','TestController2@fileUploade');
Route::post('fileUploady','TestController2@fileUploady');





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
Route::get('laboratory','FacilityAdminController@laboratory');
Route::post('facilitytest','FacilityAdminController@storelabtech');
Route::delete('lab/{id}',['as'=>'labtech.destroy','uses'=>'FacilityAdminController@destroylabtech']);
Route::get('techupdate/{id}', [ 'as' => 'labtechperson', 'uses' => 'FacilityAdminController@labtech']);
Route::Post('techupdate', [ 'as' => 'updatelabtech', 'uses' => 'FacilityAdminController@uplabtech']);

Route::get('testranges','FacilityAdminController@testranges');
Route::post('rangesadd','FacilityAdminController@rangesadd');
Route::delete('testranges/{id}',['as'=>'ranges.destroy','uses'=>'FacilityAdminController@destroyranges']);
Route::get('rangeupdate/{id}', [ 'as' => 'testsRang', 'uses' => 'FacilityAdminController@testsRang']);
Route::Post('techupdate', [ 'as' => 'updateranges', 'uses' => 'FacilityAdminController@updateranges']);

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
