<?php

namespace App\Http\Livewire\Frontend;

use App\Feed as appfeed;
use App\feed_bookmark;
use App\Http\Controllers\FeedController;
use App\like;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class FeedDetail extends Component
{
    public $feed;
    public $is_upload;
    public $response_msg;
    public $feed_addbookmark;
    public $feed_removebookmark;
    public $like_feed;
    public $unlike_feed;
    public $show_comment = false;
    public $post_comment;

    public function mount($feed){
        $this->feed = $feed;
        if(auth()->check()){
        if($this->feed->likes->where('user_id',auth()->user()->id)->count() > 0){
            $this->unlike_feed = true;
            $this->like_feed = false;
        }
        else{
            $this->unlike_feed = false;
            $this->like_feed = true;
        }
    }
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

        $this->like_feed = false;
        $this->unlike_feed = true;
    }

    public function unlike($feed_id){
        $like = like::my_likes()->byfeed($feed_id)->first();
        $like->delete();

        $this->like_feed = true;
        $this->unlike_feed = false;
    }

    public function change_feedstatus($feed_id,$feed_status){
        $feed = appfeed::find($feed_id);
        $feed->is_active = $feed_status;
        $feed->save();

        $this->emit('flash_notification','Update Feed Status Successfully','success');
    }

    public function render()
    {
        return view('livewire.frontend.feed-detail');
    }
}
