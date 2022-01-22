<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class JobSmList extends Component
{
    public $jobs;

    public function mount($jobs){
        $this->jobs = $jobs;
    }

    public function render()
    {
        return view('livewire.frontend.job-sm-list');
    }
}
