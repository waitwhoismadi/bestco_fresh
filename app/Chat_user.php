<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_user extends Model
{
    public function sender(){
        return $this->hasOne(User::class,'id','sender_id');
    }

    public function receiver(){
        return $this->hasOne(User::class,'id','receiver_id');
    }


    public function scopeMy_chatUsers($query){
        $query->orwhere('sender_id',auth()->user()->id);
        $query->orWhere('receiver_id',auth()->user()->id);
    }

    public function scopeChatMessagebyUser($query, $user_id){

        $query->where(function($query) use ($user_id){
            $query->orWhere('sender_id',$user_id);
            $query->orWhere('receiver_id',$user_id);
        });
        $query->where(function($query){
            $query->orwhere('sender_id',auth()->user()->id);
        $query->orWhere('receiver_id',auth()->user()->id);
        });

    }
}
