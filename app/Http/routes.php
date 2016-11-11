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
return view('steve');
});

Route::auth();
Route::group(['middleware' => ['auth']], function() {

Route::get('/home', 'HomeController@index');
Route::resource('users','UserController');

// Route::resource('test','TestController@index');



Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);

	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
  Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);


	Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
  Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
  Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
  Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
  Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
  Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
  Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);
});

Route::group(['middleware' => ['auth','role:Admin']], function() {
Route::resource('admin','AdminController');
Route::resource('kins','KinController');
Route::resource('facility','FacilityController');
Route::resource('county','CountyController');
Route::resource('constituency','ConstituencyController');
Route::resource('allergy','AllergyController');
Route::resource('illness','IllnessController');
Route::get('config', function () {
return view('admin.config');
});
});
// Nurse routes;
Route::group(['middleware' => ['auth','role:Admin|Nurse']], function() {
	Route::resource('nurse','NurseController');
	Route::get('newpatient', 'NurseController@newPatient');
	Route::get('waitingList', 'NurseController@wList');

	Route::get('nurse.createkin/{id}',['as'=>'createkin','uses'=>'NurseController@createnextkin']);
	Route::get('nurse.vaccine/{id}',['as'=>'vaccinescreate','uses'=>'NurseController@vaccinescreate']);
    Route::get('nurse.details/{id}',['as'=>'details','uses'=>'NurseController@details']);
	Route::post('nurse/edit',['as'=>'nextkin','uses'=>'NurseController@nextkin']);
	Route::post('nurse/edit',['as'=>'vaccine','uses'=>'NurseController@vaccine']);
    Route::post('nurse/edit',['as'=>'createdetail','uses'=>'NurseController@createdetails']);
});

// Doctor routes;
  Route::group(['middleware' => ['auth','role:Admin|Doctor']], function() {
	Route::resource('doctor','DoctorController');
	Route::get('doctorProfile', [ 'as' => 'doctorProfile', 'uses' => 'DoctorController@DocDetails']);
Route::get('newpatients', [ 'as' => 'newpatients', 'uses' => 'DoctorController@newPatients']);
  // Route::get('newpatients', 'DoctorController@newPatients');
	Route::get('patientsseen', 'DoctorController@seen');
	Route::get('allpatients', 'DoctorController@all');
	Route::resource('prescription', 'PrescriptionController@store');

  Route::Post('show', [ 'as' => 'patienttest', 'uses' => 'PatientTestController@store']);
   Route::get('testdone/{id}', [ 'as' => 'testdone', 'uses' => 'PatientController@testdone']);
   Route::get('show/{id}',['as'=>'showPatient', 'uses'=>'PatientController@showpatient']);
  });

Route::group(['middleware' => ['auth','role:Admin|Manufacturer']], function() {
Route::resource('manufacturer','ManufacturerController');
});
Route::group(['middleware' => ['auth','role:Admin|Pharmacy']], function() {
Route::resource('pharmacy','PharmacyController');
Route::get('totalsales', 'PharmacyController@totalsales');
});



Route::group(['middleware' => ['auth','role:Admin|Test|Doctor']], function() {
Route::resource('test','PatientTestController');
});
Route::group(['middleware' => ['auth','role:Admin|Patient']], function() {
	Route::resource('patient','PatientController');
});
