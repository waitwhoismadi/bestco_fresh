<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;
use App\feed_bookmark;
use App\like;
use App\Http\Controllers\JobsController;

class FeedController extends Controller
{
    //

    public static function add_bookmark($feed_id){

        $bookmark = new feed_bookmark();
        $bookmark->feed_id = $feed_id;
        $bookmark->user_id = auth()->user()->id;
        $bookmark->save();

    }


    public static function remove_bookmark($feed_id){

        $bookmark = feed_bookmark::where('feed_id',$feed_id)
                                ->where('user_id',auth()->user()->id)
                                ->first();
        $bookmark->delete();
    }

    public function delete_feed(Feed $feed){

        $feed->likes()->delete();
        $feed->bookmark()->delete();
        $feed->candidate()->delete();
        $feed->bids()->delete();
        $feed->comments()->delete();
        $feed->delete();


    }

    public function like_unlike(Request $request){


            if(!like::my_likes()->byfeed($request->feed_id)->first()){
                $like = new like();
            $like->feed_id = $request->feed_id;
            $like->user_id = auth()->user()->id;
            $like->save();
                $response['status'] = 'success';
                $response['data'] = 'like';
            }

        else{
            $like = like::my_likes()->byfeed($request->feed_id)->first();
            $like->delete();
            $response['status'] = 'success';
            $response['data'] = 'unlike';
        }

        return response()->json($response);
    }

    public function save_unsave(Request $request){


        if(!feed_bookmark::where('feed_id',$request->feed_id)
        ->where('user_id',auth()->user()->id)
        ->first()){
           self::add_bookmark($request->feed_id);
            $response['status'] = 'success';
            $response['data'] = 'save';
        }

    else{
        self::remove_bookmark($request->feed_id);
        $response['status'] = 'success';
        $response['data'] = 'unsave';
    }

    return response()->json($response);
}

public function change_feedstatus(Feed $feed){

    $feed->is_active = !$feed->is_active;
    $feed->save();

    $response['status'] = 'success';
    $response['msg'] = 'Status updated successfully';
    $response['feed'] = $feed;

    return response()->json($response);
}



}
