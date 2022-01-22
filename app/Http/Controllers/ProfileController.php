<?php

namespace App\Http\Controllers;

use App\company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProfileController extends Controller
{


    public function update_profilepic(Request $request){

            $validation= Validator::make($request->all(),[
                'profile_pic' => 'max:3072|file|mimes:jpeg,jpg,png'
            ]);

            if($validation->fails()){
                $response['status'] = 'error';
                $response['msg'] = 'File Updated Failed';
                $response['errors'] = $validation->errors();
            }
            else{

                $user = User::find(auth()->user()->id);

                    if(auth()->user()->directory == ''){

                        $user->directory = Str::plural(auth()->user()->role_type).'/'.auth()->user()->slug;
                        $user->save();

                    }



                if(auth()->user()->role_type == 'user'){
                    $path = $request->file('profile_pic')->storeAs(
                        $user->directory.'/profile-pic',$user->id.$user->slug.time().'.'.$request->file('profile_pic')->extension()
                    );
                    Storage::delete($user->image);
                    $user->image = $path;
                    $user->save();
                }
                elseif(auth()->user()->role_type == 'company'){
                    $path = $request->file('profile_pic')->storeAs(
                        $user->directory.'/profile-pic',$user->id.$user->company->slug.time().'.'.$request->file('profile_pic')->extension()
                    );

                    Storage::delete($user->company->logo);
                    $company = company::findOrFail($user->company_id);
                    $company->logo = $path;
                    $company->save();

                    $user->image = $path;
                    $user->save();

                }


                $response['status'] = 'success';
                $response['msg'] = 'File Updated Successfully';
            }

            return response()->json($response);
    }

    public function update_coverimg(Request $request){
        $validation= Validator::make($request->all(),[
            'cover_img' => 'max:3072|file|mimes:jpeg,jpg,png'
        ]);

        if($validation->fails()){
            $response['status'] = 'error';
            $response['msg'] = 'File Updated Failed';
            // $response['msg'] = $validation->errors();
        }
        else{

            $user = User::find(auth()->user()->id);

                if(auth()->user()->directory == ''){

                    $user->directory = Str::plural(auth()->user()->role_type).'/'.auth()->user()->slug;
                    $user->save();

                }


                $path = $request->file('cover_img')->storeAs(
                    $user->directory.'/cover_img',$user->id.$user->slug.time().'.'.$request->file('cover_img')->extension());
                Storage::delete($user->coverimages);
                $user->coverimages = $path;
                $user->save();




            $response['status'] = 'success';
            $response['msg'] = 'Profile Picture Updated Successfully';
        }

        return response()->json($response);
}
}
