<?php

namespace App;

use App\location\City;
use Illuminate\Database\Eloquent\Model;

class User_overview extends Model
{


    public function city_detail(){
        return $this->hasOne(City::class,'id','city');
    }
}
