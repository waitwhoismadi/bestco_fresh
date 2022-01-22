<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'company-dashboard','middleware'=>'RoleAuth:company'], function () {

    Route::get('profile','company\ProfileController@index')->name('company_dashboard.profile');
    Route::get('setting','SettingsController@index')->name('company_dashboard.setting');
    Route::post('change-password','SettingsController@change_password')->name('company_dashboard.change_password');
    Route::post('notification_setting','SettingsController@update_notification_setting')->name('company_dashboard.notification_setting');

    //-------------------------chat------------------------//

    Route::view('chat', 'chat')->name('company_dashboard.chat');

});


?>
