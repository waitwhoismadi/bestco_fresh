<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request as HttpRequest;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(HttpRequest $request)
    {

        if($request->query('redirect_to')){
            $redirect_link = Crypt::decrypt($request->query('redirect_to'));

            $request->session()->put('login_redirect_link', $redirect_link);

        }

        return view('auth.login');
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $this->register_with_sociallogin($user, $provider);

        return redirect(RouteServiceProvider::HOME);
    }

    public function register_with_sociallogin($api_user, $provider){

        $user = User::where(['provide_id'=>$api_user->getid(),'email'=>$api_user->getEmail()])->first();

        if($user != ''):

            Auth::login($user,true);

        else:

            $user = User::create([
                'role_type' => 'user',
                'name'=>$api_user->getName(),
                'email'=>$api_user->getEmail() ? $api_user->getEmail() : '',
                'password'=>'',
                'provide_id'=>$api_user->getId(),
                'image'=>$api_user->getAvatar(),
            ]);

            $user->notify(new User());
            Auth::login($user,true);
        endif;

        return;
    }
}
