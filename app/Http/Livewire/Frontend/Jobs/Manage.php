<?php

namespace App\Http\Livewire\Frontend\Jobs;

use Livewire\Component;
use App\Feed;
use App\feed_bookmark;
use App\Http\Controllers\FeedController;

class Manage extends Component
{
    public $jobs;
    public $feed_addbookmark;
    public $feed_removebookmark;

    public function mount(){
        $this->jobs = Feed::jobs()->byuser(auth()->user()->id)->get();
    }

    public function add_bookmark($feed_id){

        FeedController::add_bookmark($feed_id);

        $this->feed_addbookmark = $feed_id;
    }

    public function remove_bookmark($feed_id){

        FeedController::remove_bookmark($feed_id);

        $this->feed_removebookmark = $feed_id;

    }

    public function render()
    {
        return view('livewire.frontend.jobs.manage');
    }
}
