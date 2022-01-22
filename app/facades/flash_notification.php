<?php

namespace App\Facades;



use Illuminate\Support\Facades\Facade;



class Flash_notification{



    public static function set($message = null, $type = 'success')
    {
        return session()->flash('flash_notification', ['msg'=>$message,'type'=>$type]);;
    }

}
