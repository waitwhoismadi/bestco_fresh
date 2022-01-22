<?php

namespace App\Http\Livewire\Frontend\Companyinfo;

use Livewire\Component;

class Establish extends Component
{
    public $user;
    public $establish;

    public function mount($user){
        $this->user = $user;
        $this->establish = $this->user->overview;
    }

    public function render()
    {
        return view('livewire.frontend.companyinfo.establish');
    }
}
