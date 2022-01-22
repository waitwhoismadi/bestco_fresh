<?php

namespace App\Http\Controllers\admin;

use App\Cms_pages;
use App\Facades\Flash_notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\CmspagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CmsPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Cms_pages::latest()->get();
        return view('admin.cms.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CmspagesRequest $request)
    {
        $page = new Cms_pages();
        $page->page_type = $request->page_type??'other';
        $page->page_title = $request->page_name;
        $page->page_slug = $request->page_slug?Str::slug($request->page_slug):Str::slug($request->page_name);
        $page->page_description = $request->page_content;
        $page->seo_title = $request->seo_title;
        $page->seo_tags = $request->seo_tags;
        $page->seo_description = $request->seo_description;
        if($request->file('seo_img')){
            $path = $request->file('seo_img')->storeAs(
                'cms/seo',Str::slug($request->page_name).'.'.$request->file('seo_img')->extension()
            );
            $page->seo_img = $path;
        }
        $page->save();

        Flash_notification::set('Create Page Successfully','success');

        return redirect()->route('cms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cms_pages  $cms_pages
     * @return \Illuminate\Http\Response
     */
    public function show(Cms_pages $cms_pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cms_pages  $cms_pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Cms_pages $cm)
    {
        return view('admin.cms.edit',compact('cm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cms_pages  $cms_pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cms_pages $cm)
    {
        $cm->page_type = $request->page_type??'other';
        $cm->page_title = $request->page_name;
        $cm->page_slug = $request->page_slug?Str::slug($request->page_slug):Str::slug($request->page_name);
        $cm->page_description = $request->page_content;
        $cm->seo_title = $request->seo_title;
        $cm->seo_tags = $request->seo_tags;
        $cm->seo_description = $request->seo_description;
        if($request->file('seo_img')){
            $path = $request->file('seo_img')->storeAs(
                'cms/seo',Str::slug($request->page_name).time().'.'.$request->file('seo_img')->extension()
            );

            $cm->seo_img = $path;
        }
        $cm->save();

        Flash_notification::set('Update Page Successfully','success');

        return redirect()->route('cms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cms_pages  $cms_pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cms_pages $cm)
    {

        if($cm->page_type == 'terms'){

            Flash_notification::set('you can`t access this page','danger');

        }
        else{
            if(Storage::exists($cm->seo_img)){
                Storage::delete($cm->seo_img);

            }

            $cm->delete();

            Flash_notification::set('Delete Page Successfully','success');
        }

        return redirect()->route('cms.index');
    }
}
