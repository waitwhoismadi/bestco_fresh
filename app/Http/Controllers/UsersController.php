<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    public function users_list(Request $request){

        $query = User::users()->orderBy('id','DESC');
        if($request->query('keyword')){
            $query->where('name', 'LIKE', "%{$request->query('keyword')}%");
        }
        $users = $query->get();
        return view('user.users_list',compact('users'));

    }

    public function user_profile(User $user){
        return view('user.user_profile',compact('user'));
    }
}
