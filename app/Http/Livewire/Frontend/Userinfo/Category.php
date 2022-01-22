<?php

namespace App\Http\Livewire\Frontend\Userinfo;

use Livewire\Component;

class Category extends Component
{

    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.frontend.userinfo.category');
    }
}
