<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;
use App\User;

class About extends Component
{
    public $user;
    public $about;
    public $msg;

    public function mount($user){
        $this->user = $user;
        $this->about = $user->overview->about??'';
        $this->msg = 'success';
    }


    public function render()
    {
        return view('livewire.frontend.userinfo.about');
    }
}
