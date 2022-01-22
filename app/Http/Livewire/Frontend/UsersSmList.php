<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\follow_list;
use App\Facades\Flash_notification;
use App\User;
use App\Notifications\Followrequest;

class UsersSmList extends Component
{
    public $users;
    public $requested_id;

    public function mount($users){
        $this->users = $users;
    }

    public function follow($user_id){

        if(!follow_list::my_following($status = 'pending')->where('follow_to',$user_id)->exists()){

        $follow = new follow_list();
        $follow->follow_by = auth()->user()->id;
        $follow->follow_to = $user_id;
        $follow->follow_status = 'pending';
        $follow->save();

        $user = User::find($user_id);

        $user->notify(new Followrequest(auth()->user()));

            $this->requested_id = $user_id;
        }
        else{

            $this->emit('flash_notification','Allready sent follow request','error');
        }

    }

    public function render()
    {
        return view('livewire.frontend.users-sm-list');
    }
}
