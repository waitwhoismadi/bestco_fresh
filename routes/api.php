<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('user/category', 'CategoriesController');
Route::resource('company/industry', 'IndustriesController');
Route::resource('jobs/type', 'JobTypeController');

Route::get('jobs/{user}','JobsController@jobsbyuserid');

Route::get('states/{country_id}','Location@state_list');

Route::get('cities/{state_id}','Location@city_list');

Route::get('getseo_data/{page}', 'admin\SeoSettingController@getseodata');
Route::post('submit_seodata', 'admin\SeoSettingController@submit_seodata');


Route::get('send-test-mail','admin\SettingsController@send_test_mail');



