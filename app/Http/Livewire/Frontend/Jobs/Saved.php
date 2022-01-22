<?php

namespace App\Http\Livewire\Frontend\Jobs;

use Livewire\Component;
use App\Feed;
use App\feed_bookmark;
use App\Http\Controllers\FeedController;

class Saved extends Component
{
    public $jobs;
    public $feed_removebookmark;

    public function mount(){
        $this->jobs = feed_bookmark::Bookmarkbyuser(auth()->user()->id)->get();

    }

    public function remove_bookmark($feed_id){

        FeedController::remove_bookmark($feed_id);

        $this->feed_removebookmark = $feed_id;

    }

    public function render()
    {
        return view('livewire.frontend.jobs.saved');
    }
}
