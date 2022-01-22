<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feed_bookmark extends Model
{

    public function jobs(){
        return $this->hasMany(Feed::class,'id','feed_id')->where('feed_type','job');
    }

    public static function scopeBookmarkbyuser($query, $user_id){
        $query->where('user_id',$user_id);
    }

    public static function scopeMy_bookmark($query, $feed_id){
        $query->where('feed_id',$feed_id)->where('user_id',auth()->user()->id);
    }
}
