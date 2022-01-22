<?php

namespace App\Http\Controllers;

use App\User_overview;
use App\User_skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserOverviewController extends Controller
{


    public function update_about(Request $request){

        $user = auth()->user();

        if($user->overview){
            $overview = $user->overview;
        }
        else{
            $overview = new User_overview();
            $overview->user_id = $user->id;

        }

        $overview->about = $request->about;

            if($overview->save()){
                $response['status'] = 'success';
                $response['response'] = 'Overview Update Successfully!';
            }
            else{
                $response['status'] = 'error';
                $response['response'] = 'Overview Update Failed!';
            }

            return response()->json($response);
    }

    public function update_location(Request $request){

        $validator = Validator::make($request->all(),[
            'city' => 'required'
        ]);

        if($validator->fails()){
            $response['status'] = 'error';
            $response['response'] = 'Validation Errors';
            $response['errors'] = $validator->errors();
        }

        else{

                $user = auth()->user();

            if($user->overview){
                $location = $user->overview;
            }
            else{
                $location = new User_overview();
                $location->user_id = $user->id;

            }

            $location->city = $request->city;
            $location->address = $request->address;
            $location->save();

            $response['status'] = 'success';
            $response['response'] = 'Location Updated Successfully';
            $response['responsedata'] = view('livewire.frontend.userinfo.update_location',compact('location'))->render();


        }

        return response()->json($response);
    }

    public function store_skills(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'skill' => 'required'
        ]);

        if($validator->fails()){
            $response['status'] = 'error';
            $response['response'] = 'Validation Errors';
            $response['errors'] = $validator->errors();
        }

        else{
           $skill = new User_skills();
           $skill->user_id = auth()->user()->id;
           $skill->skill = $request->skill;
           $skill->save();

           $response['status'] = 'success';
           $response['response'] = 'Added new skill successfull!';
           $response['skill'] = $skill;

        }

        return response()->json($response);
    }

    public function delete_skill(User_skills $skill)
    {
        if($skill->delete()){
            $response['status'] = 'success';

        }
        else{
            $response['status'] = 'error';
        }

        return response()->json($response);

    }

    public function update_establish(Request $request)
    {
        $user = auth()->user();

        if($user->overview){
            $establish = $user->overview;
        }
        else{
            $establish = new User_overview();
            $establish->user_id = $user->id;

        }

        $establish->establish_date = $request->date;

            if($establish->save()){
                $response['status'] = 'success';
                $response['response'] = 'Establish date Update Successfully!';
                $response['establish'] = $establish;
            }
            else{
                $response['status'] = 'error';
                $response['response'] = 'Establish date Update Failed!';
            }

            return response()->json($response);
    }

    public function update_category(Request $request){

        $user = auth()->user();

        $request->validate([
            'category_name' => 'required'
        ]);

        auth()->user()->update([
            'category' => $request->category_name
        ]);

        $response['status'] = 'success';
        $response['response'] = 'Category Updated Successfully!';
        $response['category'] = auth()->user()->category_detail;

        return response()->json($response);
    }
}
