<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function replies(){
        return $this->hasMany(Review_reply::class,'review_id','id');
    }

    public function scopeReview_avg_byuser($query, $user_id){
        $query->where('review_to',$user_id);
        if($query->avg('rating')){
            return $query->avg('rating');
        }
        else{
            return '1.0';
        }

    }

}
