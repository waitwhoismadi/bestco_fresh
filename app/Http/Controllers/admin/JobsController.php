<?php

namespace App\Http\Controllers\admin;

use App\Feed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\Flash_notification;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Feed::jobs()->orderBy('is_active','DESC')->orderBy('created_at','DESC')->get();
        return view('admin.jobs.index',compact('jobs'));
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
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $job)
    {
        $job->likes()->delete();
        $job->bookmark()->delete();
        $job->candidate()->delete();
        $job->comments()->delete();
        $job->delete();

        Flash_notification::set('Job Deleted Successfully');
        return redirect()->route('job.index');
    }

    public function status_change(Request $request, Feed $job){

        $job->is_active = !$job->is_active;
        $job->save();

        Flash_notification::set('Job Status Changed Successfully');
        return redirect()->route('job.index');
    }

    public function job_types(){

        return view('admin.jobs.types');
    }
}
