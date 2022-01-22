<?php

use App\Http\Controllers\SettingsController;
use App\View\Components\setting\change_password;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user-dashboard','middleware'=>'RoleAuth:user'], function () {

    Route::get('profile','user\ProfileController@index')->name('user_dashboard.profile');
    Route::get('setting','SettingsController@index')->name('user_dashboard.setting');
    Route::post('change-password','SettingsController@change_password')->name('user_dashboard.change_password');
    Route::post('notification_setting','SettingsController@update_notification_setting')->name('user_dashboard.notification_setting');


    //-------------------------chat------------------------//

    Route::view('chat', 'chat')->name('user_dashboard.chat');


});


?>
