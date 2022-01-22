<?php

namespace App\Http\Livewire\Frontend\Projects;

use Livewire\Component;
use App\User;
use App\Facades\Flash_notification;
use App\Notifications\Post_bid;
use App\Project_bid;

class PlaceBid extends Component
{
    public $project;
    public $bid;
    public $delivery;
    public $detail;
    public $btn_disable = false;

    public function mount($project){
        $this->project = $project;
    }

    public function place_bid(){

        $this->validate([

            'bid' => 'required',
            'delivery' => 'required',
            'detail' => 'max:250',

        ]);

        $user = User::find(auth()->user()->id);


        $this->btn_disable = true;

            $bid = new Project_bid();
            $bid->project_id = $this->project->id;
            $bid->user_id = $user->id;
            $bid->name = $user->name;
            $bid->email = $user->email;
            $bid->your_bid = $this->bid;
            $bid->delivery_time = $this->delivery;
            $bid->description = $this->detail;


        if($bid->save()){

            $this->btn_disable = false;

            $this->project->user->notify(new Post_bid($bid,$user));

            Flash_notification::set('Place Bid Successfully','success');
            return redirect()->route('project_detail',[$this->project->slug]);

        }
    }

    public function render()
    {
        return view('livewire.frontend.projects.place-bid');
    }
}
