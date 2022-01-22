<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

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

$admin_path = realpath(__DIR__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR;
$user_path = realpath(__DIR__).DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR;
$company_path = realpath(__DIR__).DIRECTORY_SEPARATOR.'company'.DIRECTORY_SEPARATOR;

//--------------------Auth route-------------------------
Auth::routes();
Route::get('oauth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('oauth/redirect/{provider}', 'Auth\LoginController@handleProviderCallback');

Route::post('/company_register','Auth\RegisterController@company_register')->name('register.company');
Route::post('/user_register','Auth\RegisterController@user_register')->name('register.user');

Route::get('/dashboard', function () {
    // return Session::get('login_redirect_link');
    if(auth()->user() && auth()->user()->role_type == 'admin'):
        return redirect()->route('admin.home');
    else:
        if(Session::has('login_redirect_link')){
            $redirect_link = Session::get('login_redirect_link');
            Session::forget('login_redirect_link');
            return redirect()->route($redirect_link);

        }
        else{
            return redirect('/');
        }

    endif;
});

Route::get('users/{id}', function ($id) {

});

Route::get('/', 'HomeController@index')->name('home');

//---------------------users--------------------------
Route::get('/users', 'UsersController@users_list')->name('users');
Route::get('/user/{user:slug}', 'UsersController@user_profile')->name('user_profile');

//---------------------companies--------------------------
Route::get('/companies', 'CompanyController@companies_list')->name('companies');
Route::get('/company/{company:slug}', 'CompanyController@company_profile')->name('company_profile');


//---------------------Jobs-------------------------------
Route::get('/jobs','JobsController@jobs_list')->name('jobs_list');
Route::get('job/{job:slug}','JobsController@job_detail')->name('job_detail');

//---------------------Projects-------------------------------
Route::get('/projects','ProjectController@projects_list')->name('projects_list');
Route::get('project/{project:slug}','ProjectController@project_detail')->name('project_detail');

//---------------------cms pages-----------------------
Route::get('cms/{page:page_slug}','HomeController@cms_page')->name('cms_page');

include_once($admin_path .'admin.php');
include_once($user_path .'user.php');
include_once($company_path .'company.php');


include_once('custom_api.php');

Route::get('unread_notification', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('unread-notification')->middleware('auth');

Route::post('change-login-status', function (Request $request) {
    $status = $request->status; 
    $user = Auth::user();
    if($status == 'offline'){
        Cache::forget('user-is-online-' . auth()->user()->id);

        Auth::user()->update([
            'online_status' => 0
        ]);
        $user->online_status = '0';
    }
    else{
        if(!Cache::has('user-is-online-' . auth()->user()->id)){
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            Auth::user()->update([
                'online_status' => 1
            ]);
            $user->online_status = '1';
        }
    }
    $user->save();
    $response['status'] = 'success';
    $response['msg'] = 'Status changed Successfully';
    return response()->json($response);
});





