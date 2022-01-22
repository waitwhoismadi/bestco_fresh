<?php

namespace App\Http\Livewire\Frontend;

use App\Feed_comments;
use App\Notifications\FeedComment;
use Livewire\Component;

class FeedComments extends Component
{
    public $comments;
    public $feed;
    public $feed_id;
    public $post_comment;



    public function mount($comments, $feed){
        $this->comments = $comments;
        $this->feed_id = $feed->id;
        $this->feed = $feed;

    }

    public function get_comments($comments){
        $this->comments = $comments;
    }

    public function save_comment($feed_id){

        // if($this->post_comment != ''):
        $comment = new Feed_comments();
        $comment->feed_id = $feed_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $this->post_comment;
        $comment->save();

        $collection = collect($this->comments);

        $collection->push($comment);


        $this->comments = $collection->all();
        $this->emit('flash_notification','Added Job Successfully','success');
        $this->post_comment = '';

        $this->feed->user->notify(new FeedComment(auth()->user(), $this->feed));

    }

    public function render()
    {
        return view('livewire.frontend.feed-comments');
    }
}
