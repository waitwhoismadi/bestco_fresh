<?php

namespace App\Http\Livewire\Frontend\Jobs;

use App\apply_job;
use Livewire\Component;

class AppliedJobs extends Component
{
    public $jobs;

    public function mount(){
        $this->jobs = apply_job::appliedjob_byuser(auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.frontend.jobs.applied-jobs');
    }
}
