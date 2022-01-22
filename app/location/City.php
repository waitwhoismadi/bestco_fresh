<?php

namespace App\location;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    public function state_detail(){
        return $this->hasOne(State::class,'id','state_id');
    }

}
