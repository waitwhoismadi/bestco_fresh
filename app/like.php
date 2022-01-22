<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{

    public function scopeMy_likes($query){
        $query->where('user_id',auth()->user()->id);
    }

    public function scopeByfeed($query, $feed_id){
        $query->where('feed_id',$feed_id);
    }
}
