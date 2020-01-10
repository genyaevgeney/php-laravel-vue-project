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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/company/create', 'CompanyController@create');
Route::get('/company/delete/{id}', 'CompanyController@delete');
Route::get('/employee/delete/{id}', 'EmployeeController@delete');
Route::get('/companies', 'CompanyController@paginate');
Route::get('/employees', 'EmployeeController@paginate');
Route::post('/company/update/{id}', 'CompanyController@update');
Route::post('/employee/update/{id}', 'EmployeeController@update');

Route::post('/employee/create', 'EmployeeController@create');


