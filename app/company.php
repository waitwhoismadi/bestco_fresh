<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{

    public function industry_detail(){
        return $this->hasOne(industry_type::class,'id','industry');
    }

    public function user(){
        return $this->hasOne(User::class,'company_id','id');
    }

    public function scopeByauth($query){
        if(auth()->user() && auth()->user()->role_type == 'company'){
           $query->where('id','!=',auth()->user()->company_id);
        }

    }
}
