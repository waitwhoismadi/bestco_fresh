<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Notifications\Accept_bid;
use App\Project_bid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Facades\Flash_notification;

class ProjectController extends Controller
{

    public function project_bidders(Feed $project){

        $response['bidders'] = $project->bids()->with('user')->get();

        $response['is_active'] = $project->bids()->is_active()->exists();

        return response()->json($response);
    }

    public function reopen_bid(Project_bid $bid){
        $bid->bid_status = 'open';
        $bid->save();

    }

    public function accept_bid(Project_bid $bid, $Project){
        $bid->bid_status = 'accept';
        $bid->save();

        $bid->user->notify(new Accept_bid($bid));
    }

    public function projects_list(Request $request){

        $query = Feed::projects()->where('is_active',1);

        $min_price= $query->min('min_price');
        $max_price= $query->max('min_price');

        if($request->query('keyword')){
            $query->where('title', 'LIKE', "%{$request->query('keyword')}%");
        }
        if($request->query('skills')){
            $query->where('skills', 'LIKE', "%{$request->query('skills')}%");
        }
        if($request->query('availabilty')){
            $query->where('payment_type', $request->query('availabilty'));
        }
        if($request->query('budget')){
            $budget = Str::of($request->query('budget'))->explode(',');
            $query->whereBetween('min_price', [$budget]);
        }

        $projects = $query->get();



        return view('projects.projects-list',compact('projects','min_price','max_price'));
    }

    public function project_detail(Feed $project){
        if($project->feed_type == 'project' && $project->is_active){

            $project->view = $project->view + 1;
            $project->save();
        return view('projects.detail',compact('project'));
        }
        else{
            Flash_notification::set('you can`t access this feed','danger');
            return back();
        }
    }

    public function update_project(Feed $project, Request $request){

        if($project->user_id == auth()->user()->id){

            $validation = Validator::make($request->all(),[
                'project_title' => 'required|string',
                'project_category' => 'required',
                'project_budget' => 'required',
                'project_description' => 'required|min:100',
            ]);

            if($validation->fails()){
                $response['status'] = 'failed';
                $response['response'] = 'Validation Error';
                $response['msg'] = $validation->errors();
            }
            else{
                $project->title = $request->project_title;
                $project->category = $request->project_category;
                $project->skills = $request->project_skills;
                $project->min_price = $request->project_budget;
                $project->payment_type = $request->payment_type;
                $project->description = $request->project_description;

                $project->save();

                $response['status'] = 'success';
                $response['response'] = 'project Update Successfully!';
            }
        }
        else{

            $response['status'] = 'failed';
            $response['response'] = 'Authantication Error';
        }

        return response()->json($response);

    }
}
