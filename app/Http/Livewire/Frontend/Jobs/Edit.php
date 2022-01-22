<?php

namespace App\Http\Livewire\Frontend\Jobs;

use Livewire\Component;

class Edit extends Component
{
    public $edit_job;

    public function mount($edit_job){
        $this->edit_job = $edit_job;
    }

    public function render()
    {
        return view('livewire.frontend.jobs.edit');
    }
}
