<?php

namespace App\Http\Livewire\Frontend\Jobs;

use App\apply_job;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AppliedCadidates extends Component
{
    public $cadidates;
    public $delete_cadidate;

    public function mount(){
        $this->cadidates = apply_job::join('feeds', 'feeds.id', '=', 'apply_jobs.job_id')
        ->join('users', 'users.id', '=', 'apply_jobs.user_id')
        ->select('users.*','apply_jobs.*')
        ->where('feeds.user_id',auth()->user()->id)
        ->where('feeds.feed_type','job')
        ->get();

        // dd($this->cadidates);
    }



    public function render()
    {
        return view('livewire.frontend.jobs.applied-cadidates');
    }
}
