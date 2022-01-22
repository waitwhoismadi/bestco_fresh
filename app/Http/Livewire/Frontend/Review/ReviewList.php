<?php

namespace App\Http\Livewire\Frontend\Review;

use App\Review;
use Livewire\Component;

class ReviewList extends Component
{
    public $user;
    public $reviews;
    public $review_msg;
    public $review_rating;

    public function mount($user){
        $this->reviews = Review::where('review_to',$user->id)->get();
        $this->user = $user;
    }

    public function add_review(){

        if($this->review_rating < 1){
            $this->review_rating == 1;
        }

        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->review_to = $this->user->id;
        $review->rating = $this->review_rating;
        $review->description = $this->review_msg;
        $review->save();

        $this->emit('flash_notification','Your Review Added Successfully','success');
        $this->reviews = Review::where('review_to',$this->user->id)->get();
    }

    public function render()
    {
        return view('livewire.frontend.review.review-list');
    }
}
