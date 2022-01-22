<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{

    public function upload(Request $request){

        $user = User::find(auth()->user()->id);

                    if(auth()->user()->directory == ''){

                        $user->directory = Str::plural(auth()->user()->role_type).'/'.auth()->user()->slug;
                        $user->save();

                    }

        $validation = Validator::make($request->all(),[
            'pf_name'=>'required|string|max:100',
            'pf_file'=>'file|mimes:jpg,jpeg,png',
            'pf_url'=>'url',
        ]);

        if(!$validation->fails()){

            if($request->file('pf_file')){
            $path = $request->file('pf_file')->storeAs(
                $user->directory.'/portfolio',Str::slug($request->input('pf_name')).time().'.'.$request->file('pf_file')->extension()
            );
            }
            else{
                $path = null;
            }

            $pf_link = $request->input('pf_link');
            if(strpos($pf_link, 'http://') !== 0) {
                $pf_link = 'http://' . $pf_link;
              }

            $portfolio = new Portfolio();
            $portfolio->user_id = $user->id;
            $portfolio->pf_name = $request->input('pf_name');
            $portfolio->pf_file = $path;

            $portfolio->pf_link = $pf_link;
            $portfolio->save();

            $response['status']='success';
            $response['response']='Portfolio Added Successfully';
            $response['response_data']=$portfolio;
        }
        else{
            $response['status']='error';
            $response['response']='Validation Errors';
        }
        return response()->json($response);
    }
}
