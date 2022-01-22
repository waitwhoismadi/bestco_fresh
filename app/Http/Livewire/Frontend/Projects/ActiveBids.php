<?php

namespace App\Http\Livewire\Frontend\Projects;

use App\Project_bid;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActiveBids extends Component
{
    public $bids;

    public function mount(){
        $this->bids = auth()->user()->working_projects;
    }
    public function render()
    {
        return view('livewire.frontend.projects.active-bids');
    }
}
