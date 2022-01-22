<?php

namespace App\Http\Controllers;

use App\apply_job;
use App\Facades\Flash_notification;
use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    //

    public function jobsbyuserid($userid){
        $this->middleware('auth');

        $jobs = Feed::jobs()->byuser($userid)->get();

        return response()->json($jobs);
    }

    public function candidate_detail($candidate_id){

        $candidate = apply_job::find($candidate_id);

        return response()->json($candidate);
    }

    public function delete_candidate($candidate_id){
        $candidate = apply_job::find($candidate_id);
        if(Storage::exists($candidate->resume)){
            Storage::delete($candidate->resume);
        }
        $candidate->delete();

    }

    public function candidates_list(Feed $job){
        $candidates = apply_job::where('job_id',$job->id)->with('user')->get();

        return response()->json($candidates);
    }


    public function jobs_list(Request $request){

        $query = Feed::jobs()->where('is_active',1);

        $min_price= $query->min('min_price');
        $max_price= $query->max('min_price');

        if($request->query('keyword')){
            $query->where('title', 'LIKE', "%{$request->query('keyword')}%");
        }
        if($request->query('skills')){
            $query->where('skills', 'LIKE', "%{$request->query('skills')}%");
        }
        if($request->query('availabilty')){
            $query->where('job_type', $request->query('availabilty'));
        }
        if($request->query('salary')){
            $salary = Str::of($request->query('salary'))->explode(',');
            $query->whereBetween('min_price', [$salary]);
        }
        if($request->query('location')){
            $query->where('location','LIKE', "%{$request->query('location')}%");
        }
        $jobs = $query->get();



        return view('jobs.jobs-list',compact('jobs','min_price','max_price'));
    }

    public function job_detail(Feed $job){
        if($job->feed_type == 'job' && $job->is_active){

                $job->view = $job->view + 1;
                $job->save();
            return view('jobs.detail',compact('job'));
        }
        else{
            Flash_notification::set('you can`t access this feed','danger');
            return back();
        }
    }

    public function update_job(Feed $job, Request $request){

        if($job->user_id == auth()->user()->id){

            $validation = Validator::make($request->all(),[
                'job_title' => 'required|string',
                'job_category' => 'required',
                'job_location' => 'required',
                'job_description' => 'required|min:100',
            ]);

            if($validation->fails()){
                $response['status'] = 'failed';
                $response['response'] = 'Validation Error';
                $response['msg'] = $validation->errors();
            }
            else{
                $job->title = $request->job_title;
                $job->category = $request->job_category;
                $job->skills = $request->job_skills;
                $job->min_price = $request->job_salary;
                $job->job_type = $request->job_type;
                $job->description = $request->job_description;
                $job->location = $request->job_location;

                $job->save();

                $response['status'] = 'success';
                $response['response'] = 'Job Update Successfully!';
            }
        }
        else{

            $response['status'] = 'failed';
            $response['response'] = 'Authantication Error';
        }

        return response()->json($response);

    }
}
