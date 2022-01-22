<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserregistrationRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Facades\Flash_notification;

use flash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('RoleAuth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::where('role_type','user')->get();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserregistrationRequest $request)
    {
        $directory = 'users/'.Str::slug($request->name);
        Storage::makeDirectory($directory);

        $user = new User();
        $user->role_type = 'user';
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->category = $request->category;
        $user->password = Hash::make($request->password);
        $user->directory = $directory;

        $user->save();

        flash_notification::set('User Added Successfully.');

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>['required','string'],
            'email'=>['required',Rule::unique('users','email')->ignore($user->id),'string','email'],
            'category'=>['required'],
            'password'=>['confirmed']
        ]);

        $user->update([
            'name'=>$request->input('name'),
            'slug'=>Str::slug($request->input('name')),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'category'=>$request->input('category'),
            'password'=>$request->input('password')?Hash::make($request->input('password')):$user->password,
        ]);

        Flash_notification::set('User Updated Successfully');

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        Flash_notification::set('Delete User Successfully');

        return redirect()->route('admin.user.index');
    }

    public function categories(){

        return view('admin.users.category');
    }
}
