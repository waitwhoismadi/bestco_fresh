<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;

class Experience extends Component
{
    public $user;
    public $experiences;

    public function mount($user){
        $this->user = $user;
        $this->experiences = $user->experience;
    }
    public function render()
    {
        return view('livewire.frontend.userinfo.experience');
    }
}
