<?php

namespace App\Http\Livewire\Frontend\Projects;

use Livewire\Component;
use App\Feed;
use App\Http\Controllers\FeedController;

class Manage extends Component
{
    public $projects;

    public function mount(){
        $this->projects = Feed::projects()->byuser(auth()->user()->id)->get();
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
        return view('livewire.frontend.projects.manage');
    }
}
