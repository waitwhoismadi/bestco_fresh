<?php

namespace App\Http\Livewire\Frontend;

use App\Feed;
use App\feed_bookmark;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class Feedcomponent extends Component
{

    public $feeds;
    public $is_upload;
    public $response_msg;
    public $feed_bookmark;

    public $job_title;
    public $job_category;
    public $job_skills;
    public $salary;
    public $job_type;
    public $job_description;

    public $project_title;
    public $project_category;
    public $project_skills;
    public $budget;
    public $payment_type;
    public $project_description;

    public function mount($feeds){
        $this->feeds = $feeds;
        $this->is_upload = true;

    }

    public function clear_jobform(){
        $this->job_title = '';
        $this->job_category = '';
        $this->job_skills = '';
        $this->salary = '';
        $this->job_type = '';
        $this->job_description = '';
    }

    public function clear_projectform(){
        $this->project_title = '';
        $this->project_category = '';
        $this->project_skills = '';
        $this->budget = '';
        $this->payment_type = '';
        $this->project_description = '';
    }

    public function post_job(){
        $this->validate([
            'job_title' => 'required|string',
            'job_category' => 'required',
            'job_description' => 'required|min:100',
        ]);

        $job= new Feed();
        $job->feed_type = 'job';
        $job->user_id = auth()->user()->id;
        $job->title = $this->job_title;
        $job->slug = $this->create_slug(Str::slug($this->job_title));
        $job->category = $this->job_category;
        $job->skills = $this->job_skills;
        $job->min_price = $this->salary;
        $job->job_type = $this->job_type;
        $job->description = $this->job_description;

        $job->save();

        $this->clear_jobform();

        $this->response_msg = 'Added Job Successfully';

    }

    public function post_project(){
        $this->validate([
            'project_title' => 'required|string',
            'project_category' => 'required',
            'budget' => 'required',
            'payment_type' => 'required',
            'project_description' => 'required|min:100',
        ]);

        $job= new Feed();
        $job->feed_type = 'project';
        $job->user_id = auth()->user()->id;
        $job->title = $this->project_title;
        $job->slug = $this->create_slug(Str::slug($this->project_title));
        $job->category = $this->project_category;
        $job->skills = $this->project_skills;
        $job->min_price = $this->budget;
        $job->payment_type = $this->payment_type;
        $job->description = $this->project_description;

        $job->save();

        $this->clear_projectform();

        $this->response_msg = 'Added Job Successfully';

    }

    public function create_slug($slug){
        $token = Str::random('6');
        $full_slug = $slug.'-'.$token;
        if(feed::where('slug',$slug,$full_slug)->exists()){
            $this->create_slug($slug);
        }
        else{
            return $full_slug;
        }
    }

    public function add_bookmark($feed_id){
        $bookmark = new feed_bookmark();
        $bookmark->feed_id = $feed_id;
        $bookmark->user_id = auth()->user()->id;
        $bookmark->save();

        $this->feed_bookmark = $feed_id;
    }

    public function remove_bookmark($feed_id){
        // $bookmark = feed_bookmark::where('feed_id',$feed_id)
        //                         ->where('user_id',auth()->user()->id)
        //                         ->first();
        // $bookmark->delete();

        // $this->feed_bookmark = $feed_id;
        dd($feed_id);
    }

    public function render()
    {
        return view('livewire.frontend.feedcomponent');
    }
}
