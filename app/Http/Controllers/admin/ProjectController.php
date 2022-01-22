<?php

namespace App\Http\Controllers\admin;

use App\Feed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\Flash_notification;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects= Feed::projects()->orderBy('is_active','DESC')->orderBy('created_at','DESC')->get();
        return view('admin.projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feed  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feed  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feed  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feed  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $project)
    {
        $project->likes()->delete();
        $project->bookmark()->delete();
        $project->bids()->delete();
        $project->comments()->delete();
        $project->delete();

        Flash_notification::set('Project Deleted Successfully');
        return redirect()->route('project.index');
    }

    public function status_change(Request $request, Feed $project){


        $project->is_active = !$project->is_active;
        $project->save();

        if($project->is_active):

            $project->bids->update([
                'bid_status' => 'open'
            ]);

        endif;

        Flash_notification::set('Project Status Changed Successfully');
        return redirect()->route('project.index');
    }
}
