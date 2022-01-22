<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','middleware'=>'RoleAuth:admin'], function () {
    Route::get('dashboard', 'admin\AdminController@index')->name('admin.home');

    //---------------users ----------------------
    Route::resource('user', 'admin\UserController')->names([
        'index'=>'admin.user.index',
        'create'=>'admin.user.create',
        'store'=>'admin.user.store',
        'edit'=>'admin.user.edit',
        'update'=>'admin.user.update',
        'destroy'=>'admin.user.delete',
    ]);

    Route::get('users/categories','admin\UserController@Categories')->name('admin.user.categories');


    //---------------company ----------------------
    Route::resource('company', 'admin\CompanyController')->names([
        'index'=>'admin.company.index',
        'create'=>'admin.company.create',
        'store'=>'admin.company.store',
        'edit'=>'admin.company.edit',
        'update'=>'admin.company.update',
        'destroy'=>'admin.company.delete',
    ]);

    Route::get('companies/industries','admin\CompanyController@industries')->name('admin.companies.industries');


    //--------------Jobs---------------------

    Route::resource('job', 'admin\JobsController');
    Route::put('job/change-status/{job}', 'admin\JobsController@status_change')->name('job.change_status');
    Route::get('jobs/types', 'admin\JobsController@job_types')->name('job.type.index');

     //--------------projects---------------------

     Route::resource('project', 'admin\ProjectController');
     Route::put('project/change-status/{project}', 'admin\ProjectController@status_change')->name('project.change_status');

     //--------------cms---------------------

     Route::resource('cms', 'admin\CmsPagesController');

     //--------------seo--------------------

     Route::get('seo','admin\SeoSettingController@index')->name('seo.index');

     //--------------settings----------------

     Route::group(['prefix' => 'settings'], function () {

        Route::get('general','admin\SettingsController@general_setting_form')->name('setting.general');
        Route::post('general','admin\SettingsController@general_setting_update')->name('setting.general.update');
        Route::get('mail','admin\SettingsController@mail_setting_form')->name('setting.mail');
        Route::post('mail','admin\SettingsController@mail_setting_update')->name('setting.mail.update');
     });

});

Route::get('developer/artisan-command','CommandController@run')->name('command');
Route::get('developer/storage-link', 'CommandController@storage_link');
?>
