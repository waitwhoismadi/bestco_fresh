<?php

namespace App\Http\Controllers;

use App\location\City;
use App\location\State;
use Illuminate\Http\Request;

class Location extends Controller
{

    public function state_list($country_id){

        $state = State::where('country_id',$country_id)->orderBy('name','ASC')->get();
        return response()->json($state);
    }

    public function city_list($state_id){
        $city = City::where('state_id',$state_id)->orderBy('name','ASC')->get();
        return response()->json($city);
    }
}
