<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;

class Education extends Component
{
    public $user;
    public $educations;

    public function mount($user){
        $this->user = $user;
        $this->educations = $this->user->education;
    }

    public function render()
    {
        return view('livewire.frontend.userinfo.education');
    }
}
