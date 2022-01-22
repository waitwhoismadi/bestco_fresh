<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Feed as appfeed;
use Illuminate\Support\Str;

class AddFeed extends Component
{

    public $loadbtn = false;
    public $response_msg;

    public $job_title;
    public $job_category;
    public $job_skills;
    public $job_location;
    public $salary;
    public $job_type;
    public $job_description;

    public $project_title;
    public $project_category;
    public $project_skills;
    public $budget;
    public $payment_type;
    public $project_description;

    public function clear_jobform(){
        $this->job_title = '';
        $this->job_category = '';
        $this->job_skills = '';
        $this->job_location = '';
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
        // $this->validate([
        //     'job_title' => 'required|string',
        //     'job_category' => 'required',
        //     'job_location' => 'required',
        //     'job_description' => 'required|min:100',
        // ]);

        $job= new appfeed();
        $job->feed_type = 'job';
        $job->user_id = auth()->user()->id;
        $job->title = $this->job_title;
        $job->slug = $this->create_slug(Str::slug($this->job_title));
        $job->category = $this->job_category;
        $job->skills = $this->job_skills;
        $job->min_price = $this->salary;
        $job->job_type = $this->job_type;
        $job->description = $this->job_description;
        $job->location = $this->job_location;

        $job->save();

        $this->clear_jobform();


        $this->emit('flash_notification','Added Job Successfully','success');

    }

    public function post_project(){


        $this->loadbtn = true;
        // $data = $this->validate([
        //     'project_title' => 'required|string',
        //     'project_category' => 'required',
        //     'budget' => 'required',
        //     'payment_type' => 'required',
        //     'project_description' => 'required',
        // ]);

        // dd($this->project_title);

        $job= new appfeed();
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

        $this->emit('flash_notification','Added Job Successfully','success');

    }

    public function create_slug($slug){
        $token = Str::random('6');
        $full_slug = $slug.'-'.$token;
        if(appfeed::where('slug',$slug,$full_slug)->exists()){
            $this->create_slug($slug);
        }
        else{
            return $full_slug;
        }
    }

    public function render()
    {
        return view('livewire.frontend.add-feed');
    }
}
