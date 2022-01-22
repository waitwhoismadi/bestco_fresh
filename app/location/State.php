<?php

namespace App\location;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    public function country_detail(){
        return $this->hasOne(Country::class,'id','country_id');
    }

}
