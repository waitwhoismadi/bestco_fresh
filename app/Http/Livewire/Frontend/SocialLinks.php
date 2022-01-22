<?php

namespace App\Http\Livewire\Frontend;

use App\User;
use App\User_social_links;
use Livewire\Component;

class SocialLinks extends Component
{
    public $user;
    public $links;

    //-------------links------------

    public $website;
    public $facebook;
    public $instagram;
    public $twitter;
    public $github;
    public $pinterest;
    public $youtube;



    public function mount($user){

        $this->user = User::find($user->id);
        $this->links = $this->user->social_link;

        $this->sync_links($this->links);
    }

    public function sync_links($links){
        if($links){
            $this->website = $links->website;
            $this->facebook = $links->facebook;
            $this->instagram = $links->instagram;
            $this->twitter = $links->twitter;
            $this->github = $links->github;
            $this->pinterest = $links->pinterest;
            $this->youtube = $links->youtube;
        }
    }

    public function update_links(){

        if($this->links){

            $links = $this->links;
        }
        else{
            $links = new User_social_links();
            $links->user_id = auth()->user()->id;
        }

            $links->website = $this->add_http($this->website);
            $links->facebook = $this->add_http($this->facebook);
            $links->instagram = $this->add_http($this->instagram);
            $links->twitter = $this->add_http($this->twitter);
            $links->github = $this->add_http($this->github);
            $links->pinterest = $this->add_http($this->pinterest);
            $links->youtube = $this->add_http($this->youtube);

            $links->save();

            $this->links = $links;
            $this->sync_links($links);

            $this->emit('flash_notification','Links Updated Successfully','success');

    }

    public function add_http($link){

        if(strpos($link, 'http://') !== 0 || $link !== '') {
            return 'http://' . $link;
          }
          else{
              return $link;
          }

    }

    public function render()
    {
        return view('livewire.frontend.social-links');
    }
}
