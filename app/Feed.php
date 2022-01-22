<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function category_detail(){
        return $this->hasOne(user_categories::class,'id','category');
    }

    public function payment_types(){
        return $this->hasOne(payment_type::class,'id','payment_type');
    }

    public function job_types(){
        return $this->hasOne(job_type::class,'id','job_type');
    }

    public function bookmark(){
        return $this->hasMany(feed_bookmark::class,'feed_id','id');
    }

    public function candidate(){
        return $this->hasMany(apply_job::class,'job_id','id');
    }

    public function scopeJobs($query){
        $query->where('feed_type','job');
    }

    public function scopeProjects($query){
        $query->where('feed_type','project');
    }

    public function scopeByuser($query, $user_id){
        $query->where('user_id',$user_id);
    }

    public function likes(){
        return $this->hasMany(like::class,'feed_id','id');
    }

    public function bids(){
        return $this->hasMany(Project_bid::class,'project_id','id');
    }

    public function comments(){
        return $this->hasMany(Feed_comments::class,'feed_id','id');
    }
}
