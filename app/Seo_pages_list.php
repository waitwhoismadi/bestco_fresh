<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo_pages_list extends Model
{

    public function seo()
    {
        return $this->hasOne(Seo_setting::class,'page_type','id');
    }
}
