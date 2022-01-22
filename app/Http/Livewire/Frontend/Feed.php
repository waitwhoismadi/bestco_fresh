<?php

namespace App\Http\Livewire\Frontend;

use App\Feed as appfeed;
use App\feed_bookmark;
use App\Http\Controllers\FeedController;
use App\like;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;
use App\follow_list;
use App\Facades\Flash_notification;
use App\Notifications\Followrequest;
use App\User;

class Feed extends Component
{
    public $feeds;
    public $is_upload;
    public $response_msg;
    public $feed_addbookmark;
    public $feed_removebookmark;
    public $like_feed;
    public $unlike_feed;
    public $show_comment = false;
    public $post_comment;
    public $update_job;
    public $requested_id;

    public function mount($feeds){
        $this->feeds = $feeds;
        $this->is_upload = true;
        $this->update_job = $feeds->find(2);

    }


    public function add_bookmark($feed_id){

        FeedController::add_bookmark($feed_id);

        $this->feed_addbookmark = $feed_id;
    }

    public function remove_bookmark($feed_id){

        FeedController::remove_bookmark($feed_id);

        $this->feed_removebookmark = $feed_id;
        // dd($feed_id);
    }

    public function like($feed_id){
        $like = new like();
        $like->feed_id = $feed_id;
        $like->user_id = auth()->user()->id;
        $like->save();

        $this->like_feed = $feed_id;
        $this->unlike_feed = '';
    }

    public function unlike($feed_id){
        $like = like::my_likes()->byfeed($feed_id)->first();
        $like->delete();

        $this->like_feed = '';
        $this->unlike_feed = $feed_id;
    }

    public function change_feedstatus($feed_id,$feed_status){
        $feed = appfeed::find($feed_id);
        $feed->is_active = $feed_status;
        $feed->save();

        $this->emit('flash_notification','Update Feed Status Successfully','success');
    }

    public function edit_job($feed){
        $this->update_job = $feed;
        // dd($this->update_job);
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
        $this->emit('flash_notification','UnFollow User Successfully','success');
    }

    public function render()
    {
        return view('livewire.frontend.feed');
    }
}
