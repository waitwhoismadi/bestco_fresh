<?php

namespace App\Http\Controllers\Auth;

use App\company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyregistrationRequest;
use App\Http\Requests\UserregistrationRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\CompanyController as companyctrl;
use App\Notifications\New_register;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function user_register(UserregistrationRequest $request){

        $request->session()->put('register_type', 'user');

        $directory = 'users/'.Str::slug($request->input('name'));
        Storage::makeDirectory($directory);
        $user = new User();
        $user->role_type = 'user';
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->slug = Str::slug($request->input('name'));
        $user->category = $request->input('category');
        $user->password = Hash::make($request->input('password'));
        $user->directory = $directory;

        $user->save();

        $user->notify(new New_register());

        Auth::login($user);
        return  redirect(RouteServiceProvider::HOME);
    }

    public function company_register(CompanyregistrationRequest $request){


        $company = companyctrl::save_company($request);

        $directory = 'companies/'.$company->slug;
        Storage::makeDirectory($directory);

        $user = new User();
        $user->role_type = 'company';
        $user->company_id = $company->id;
        $user->name = $company->company_name;
        $user->email = $company->email;
        $user->slug = $company->slug;
        $user->password = Hash::make($request->input('password'));
        $user->directory = $directory;

        $user->save();

        $user->notify(new New_register());

        Auth::login($user);
        return  redirect(RouteServiceProvider::HOME);
    }


}
