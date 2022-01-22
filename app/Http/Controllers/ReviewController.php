<?php

namespace App\Http\Controllers;

use App\Review_reply;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function save_reply(Request $request){

        $reply = new Review_reply();
        $reply->user_id = auth()->user()->id;
        $reply->review_id = $request->input('review_id');
        $reply->description = $request->input('reply_text');


        if($reply->save()){
            $response['status'] = 'success';
            $response['response'] = 'Send Reply Successfully';

            $append_data = view('livewire.frontend.review.review-reply-append', compact('reply'))->render();

            $response['append'] = $append_data;
        }
        else{
            $response['status'] = 'error';
            $response['response'] = 'Send Reply Failed';
        }

        return response()->json($response);
    }

}
