<?php

namespace App\Http\Controllers;

use App\Facades\Flash_notification;
use App\Http\Requests\PasswordRequest;
use App\User_notification_setting;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{



    public function index(){

        return view('settings');

    }

    public function change_password(PasswordRequest $request){

        $user = auth()->user();
        $user->update(['password' => Hash::make($request->get('password'))]);

        Flash_notification::set('Update Password Successfully','success');

        if(auth()->user()->role_type == 'company'):
        return redirect()->route('company_dashboard.setting',['page'=>'change-password']);
        else:
        return redirect()->route('user_dashboard.setting',['page'=>'change-password']);
        endif;

    }

    public function update_notification_setting(Request $request){
        $user = auth()->user();
        if($user->notification_setting){
            $notification_setting = $user->notification_setting;
        }
        else{
            $notification_setting = new User_notification_setting();
            $notification_setting->user_id = $user->id;
        }


        $notification_setting->request_notification = $request->follow_request?1:0;
        $notification_setting->feedcomment_notification = $request->comment?1:0;
        $notification_setting->jobapply_notification = $request->job_apply?1:0;
        $notification_setting->projectbid_notification = $request->bid?1:0;
        $notification_setting->acceptbid_notification = $request->acceptbid?1:0;
        $notification_setting->message_notification = $request->message?1:0;

        $notification_setting->save();

        Flash_notification::set('Update Password Successfully','success');

        if(auth()->user()->role_type == 'company'):
        return redirect()->route('company_dashboard.setting',['page'=>'account']);
        else:
        return redirect()->route('user_dashboard.setting',['page'=>'account']);
        endif;
    }
}
