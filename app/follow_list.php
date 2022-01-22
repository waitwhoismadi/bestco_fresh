<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class follow_list extends Model
{


    public function scopeMy_following($query,$status='approve',$type= null){
        $query->where('follow_by',auth()->user()->id);
        if(!$type == 'all'):
        $query->where('follow_status',$status);
        endif;
    }

    public function scopeMy_follower($query,$status='approve',$type=null){
        $query->where('follow_to',auth()->user()->id);
        if(!$type == 'all'):
            $query->where('follow_status',$status);
        endif;
    }

    public function scopeFollowing_byuser($query,$user_id,$status='approve',$type= null){
        $query->where('follow_by',$user_id);
        if(!$type == 'all'):
        $query->where('follow_status',$status);
        endif;
    }

    public function scopeFollower_byuser($query,$user_id,$status='approve',$type=null){
        $query->where('follow_to',$user_id);
        if(!$type == 'all'):
            $query->where('follow_status',$status);
        endif;
    }

    public function followeruser(){
        return $this->hasOne(User::class,'id','follow_by');
    }

}
