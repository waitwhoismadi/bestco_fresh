<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;

class Allinfo extends Component
{
    public $user;

    public function mount($user){
        $this->user = $user;
    }
    
    public function render()
    {
        return view('livewire.frontend.userinfo.allinfo');
    }
}
