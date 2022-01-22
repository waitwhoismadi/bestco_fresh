<?php

namespace App\Http\Livewire\Frontend\Setting;

use App\follow_list;
use Livewire\Component;

class AcceptRequest extends Component
{

    public $follow_requests;

    public function mount(){
        $this->get_follow_request();
    }

    public function get_follow_request(){
        $this->follow_requests = follow_list::my_follower('pending')->get();
    }

    public function accept_request($request_id){
        $accept_request = $this->follow_requests->find($request_id);
        $accept_request->follow_status = 'approve';
        $accept_request->save();

        $this->emit('flash_notification','Request accept Successfully','success');

        $this->get_follow_request();
    }

    public function delete_request($request_id){
        $accept_request = $this->follow_requests->find($request_id);
        $accept_request->delete();

        $this->emit('flash_notification','Request Delete Successfully','success');

        $this->get_follow_request();
    }

    public function render()
    {
        return view('livewire.frontend.setting.accept-request');
    }
}
