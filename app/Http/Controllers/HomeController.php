<?php

namespace App\Http\Controllers;

use App\Cms_pages;
use App\Seo_pages_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        session()->forget('register_type');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public static function remove_veriable_geturl($url = null,$remove_variable = null){

        $custom_url = '';

             $parsed = parse_url($url);
            $query = $parsed['query'];

            parse_str($query, $params);

            unset($params[$remove_variable]);
            $string = http_build_query($params);

            // if($add_variable && $remove_value):
            //    $remove_value = [$remove_value];
            //     $add_variable = array_diff($add_variable,$remove_value);

            //         foreach($add_variable as $key => $vari){
            //           $custom_url .='&'.$remove_variable.'[]='.$vari;
            //         }
            // endif;

            return $string.$custom_url;
    }

    public function cms_page(Cms_pages $page){
        $seo = ([
            'seo_title' => $page->seo_title,
            'seo_tags' => $page->seo_tags,
            'seo_img' => $page->seo_img,
            'seo_description' => $page->seo_description
        ]);

        return view('cms_page',compact('seo','page'));
    }
}
