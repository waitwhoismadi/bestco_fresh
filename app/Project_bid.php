<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_bid extends Model
{

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function project(){
        return $this->hasOne(Feed::class,'id','project_id');
    }

    public function scopeAvg_bid($query, $project_id){
        $query->where('project_id',$project_id);

        if($query->avg('your_bid')){
            return $query->avg('your_bid');
        }
        else{
            return '0.0';
        }
    }

    public function scopeIs_active($query){
        $query->where('bid_status','accept');

    }
}
