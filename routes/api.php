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

});


