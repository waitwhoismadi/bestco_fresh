<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class apply_job extends Model
{

    public function jobs(){
        return $this->hasMany(Feed::class,'id','job_id')->where('feed_type','job');
    }

    public function job(){
        return $this->hasOne(Feed::class,'id','job_id')->where('feed_type','job');
    }

    public function scopeAppliedjob_byuser($query, $user_id){
        $query->where('user_id',$user_id);
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
