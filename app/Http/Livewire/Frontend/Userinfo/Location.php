<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;

class Location extends Component
{
    public $user;
    public $location;

    public function mount($user){
        $this->user = $user;
        if($user->overview):
        $this->location = $user->overview->city?$user->overview:'';
        else:
        $this->location = '';
        endif;
    }

    public function render()
    {
        return view('livewire.frontend.userinfo.location');
    }
}
