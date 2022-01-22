<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\follow_list;
use App\User;
use App\Notifications\Followrequest;

class CompaniesList extends Component
{
    public $companies;
    public $requested_id;

    public function mount($companies){
        $this->companies = $companies;
    }

    public function follow($user_id){

        $follow = new follow_list();
        $follow->follow_by = auth()->user()->id;
        $follow->follow_to = $user_id;
        $follow->follow_status = 'pending';
        $follow->save();

        $this->requested_id = $user_id;

        $user = User::find($user_id);

        $user->notify(new Followrequest(auth()->user()));

        $this->emit('flash_notification','Send Follow Request Successfully','success');
    }

    public function unfollow($user_id){

        $follow = follow_list::where('follow_by',auth()->user()->id)->where('follow_to',$user_id)->first();
        $follow->delete();

        // $this->requested_id = $user_id;
        $this->emit('flash_notification','UnFollow Company Successfully','success');
    }

    public function render()
    {
        return view('livewire.frontend.companies-list');
    }
}
