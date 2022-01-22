<?php

namespace App\Http\Livewire\Frontend\Jobs;

use App\apply_job;
use App\Facades\Flash_notification;
use App\Http\Requests\ApplyjobRequest;
use App\Notifications\Job_apply;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\User;
use Illuminate\Support\Str;

class ApplyJob extends Component
{
    use WithFileUploads;


    public $job;
    public $full_name;
    public $email;
    public $contact;
    public $experience;
    public $file;
    public $btn_disable = false;

    public function mount($job){
        $this->job = $job;
    }

    public function apply_job(){



        $this->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'contact' => 'required|min:10',
            'experience' => 'required',
            'file' => 'mimes:pdf,doc,docx|max:3072',
        ]);

        $user = User::find(auth()->user()->id);

            if(auth()->user()->directory == ''){

                $user->directory = Str::plural(auth()->user()->role_type).'/'.auth()->user()->slug;
                $user->save();

            }

            $this->btn_disable = true;

            $apply_job = new apply_job();
            $apply_job->job_id = $this->job->id;
            $apply_job->user_id = $user->id;
            $apply_job->name = $this->full_name;
            $apply_job->email = $this->email;
            $apply_job->contact = $this->contact;
            $apply_job->experience = $this->experience;
        if($this->file){

           $path= $this->file->storeAs(
                $user->directory.'/resume',$user->id.$user->slug.time().'.'.$this->file->extension()
            );

            $apply_job->resume = $path;
        }
        if($apply_job->save()){


            $this->job->user->notify(new Job_apply($apply_job,$user));

            $this->btn_disable = false;

            Flash_notification::set('Apply Job Successfully','success');
            return redirect()->route('job_detail',[$this->job->slug]);

        }
    }

    public function render()
    {
        return view('livewire.frontend.jobs.apply-job');
    }
}
