<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{

    public function run(Request $request){
         $msg = Artisan::call('db:seed --class=Seopageslist');
         return $msg;
    }

    public function storage_link(){

            $targetFolder = storage_path("app");
            $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
            symlink($targetFolder, $linkFolder);

    }
}
