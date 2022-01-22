<?php

namespace App\Http\Controllers\admin;

use App\Seo_pages_list;
use App\Seo_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SeoSettingController
{

    public function index()
    {
        $pages = Seo_pages_list::all();
        return view('admin.seo.index',compact('pages'));
    }

    public function getseodata(Seo_pages_list $page)
    {
        $data = $page->seo;

        return response()->json($data,200);
    }

    public function submit_seodata(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'seo_title'=>['required','max:100'],
            'seo_description' =>['required','max:180']
        ]);

        if($validation->fails()){
            $response['status'] = 'error';
            $response['errors'] = $validation->errors();
        }
        else{

            if($request->page_type && Seo_setting::where('page_type',$request->page_type)->exists()){

                $seo = Seo_setting::where('page_type',$request->page_type)->first();
            }
            else{
                $seo = new Seo_setting();
                $seo->page_type = $request->page_type;
            }


            $seo->seo_title = $request->seo_title;
            $seo->seo_tags = $request->seo_tags;
            $seo->seo_description = $request->seo_description;
            $seo->save();

            $response['status'] = 'success';
            $response['seodata'] = $seo;
        }

        return response()->json($response,200);

    }
}
