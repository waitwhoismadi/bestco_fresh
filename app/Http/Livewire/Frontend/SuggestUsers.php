<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Flash_notification;
use App\follow_list;
use App\User;
use Livewire\Component as LivewireComponent;

class SuggestUsers extends LivewireComponent
{
    public $users;

    public function mount(){
        $this->users = User::suggestusers()->users()->limit('10')->get();
    }


    public function render()
    {

        return view('livewire.frontend.suggest-users');
    }

}
