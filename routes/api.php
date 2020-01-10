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
	return $request->user();
});

// Route::post('login', 'ApiController@login');
// Route::post('register', 'ApiController@register');

// Route::group(['middleware' => 'auth.jwt'], function () {
// 	Route::get('logout', 'ApiController@logout');
// 	Route::post('/company/create', 'CompanyController@create');
// 	Route::get('/company/delete/{id}', 'CompanyController@delete');
// 	Route::get('/employee/delete/{id}', 'EmployeeController@delete');
// 	Route::get('/companies', 'CompanyController@paginate');
// 	Route::get('/employees', 'EmployeeController@paginate');
// 	Route::post('/company/update/{id}', 'CompanyController@update');
// 	Route::post('/employee/update/{id}', 'EmployeeController@update');

// 	Route::post('/employee/create', 'EmployeeController@create');
//     // Route::get('tasks', 'TaskController@index');
//     // Route::get('tasks/{id}', 'TaskController@show');
//     // Route::post('tasks', 'TaskController@store');
//     // Route::put('tasks/{id}', 'TaskController@update');
//     // Route::delete('tasks/{id}', 'TaskController@destroy');
// });
Route::apiResources([
    'companies' => 'API\CompanyController',
    'employees' => 'API\EmployeeController'
]);

Route::group(['prefix' => 'auth'], function ($router) {
	
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('refresh', 'AuthController@refresh');
Route::get('me', 'AuthController@me');
// Route::post('/company/create', 'CompanyController@create');
// Route::get('/companies', 'CompanyController@paginate');
});


