<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Chat_user;
use App\Feed;
use App\Notifications\Send_msg;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public static function create_link($role = '',$user_id = '',$msg_type = '',$msg_id = ''){

        $msg = '';

        $user = User::find($user_id);
        if($msg_type == 'job'){
            $job = Feed::find($msg_id);
            $msg = 'Hi '.$user->name.', I am interesting '.$job->title.' job.';
        }
        elseif($msg_type == 'project'){
            $project = Feed::find($msg_id);
            $msg = 'Hi '.$user->name.', I am interesting '.$project->title.' project.';
        }
        return route($role.'_dashboard.chat',['user'=>$user_id,'message'=>$msg]);
    }
    public function get_chat_users()
    {

        $users = Chat::my_chatUsers()
        ->with('sender','receiver')
        ->groupBy('chat_id')
        ->orderBy('id','DESC')
        ->get();

        return response()->json($users);
    }

    public function get_chat_messages($chat_id)
    {

        Chat::where('chat_id',$chat_id)->update(['is_read'=>'1']);
        $messages = Chat::where('chat_id',$chat_id)
        ->with('sender','receiver')
        ->orderBy('created_at','ASC')
        ->get();



        return response()->json($messages);
    }

    public function send_message(Request $request)
    {
        $user = Chat_user::my_chatUsers()->chatMessagebyUser($request->receiver)->first();

        if(!$user){

            $user = new Chat_user();
            $user->sender_id = auth()->user()->id;
            $user->receiver_id = $request->receiver;
            $user->save();
        }


        $chat = new Chat();
        $chat->chat_id = $user->id;
        $chat->sender_id = auth()->user()->id;
        $chat->receiver_id = $request->receiver;
        $chat->message = $request->msg;
        $chat->save();

        $chat_user = User::find($request->receiver);

        $chat_user->notify(new Send_msg);

        return response()->json($chat);
    }

    public function get_last_messages($chat_id,$type){
        $messages = Chat::where('chat_id',$chat_id);



        if($type == 'unread'){
            $response = $messages->where('is_read','0')->count();
        }
        if($type == 'msg'){
            $response = $messages->OrderBy('id','DESC')->first()->message;
        }
        if($type == 'time'){
             $response = $messages->OrderBy('id','DESC')->first()->created_at;
        }

        return $response;
    }

    public function get_custom_user($receiver){
        $user = Chat_user::chatMessagebyUser($receiver)->with('sender','receiver')->first();

        if(!$user){
            if(User::where('id',$receiver)->where('role_type','!=','admin')->exists()):

            $response['user'] = User::where('id',$receiver)->first();
            $response['status'] = 'not-found';
            endif;
        }
        else{
            $response['user'] = $user;
            $response['status'] = 'found';
        }

        return response()->json($response);
    }
}
