<?php

namespace App\Http\Controllers\admin;

use App\admin_setting\EmailConfig;
use App\admin_setting\General_setting;
use App\Facades\Flash_notification;
use App\Http\Controllers\Controller;
use App\Mail\Test_mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function general_setting_form(){

        $setting = General_setting::find(1);

        return view('admin.setting.general',compact('setting'));
    }

    public function general_setting_update(Request $request){

        $setting = General_setting::find(1);

        $request->validate([
            'site_name' => 'required|max:150',
            'site_title' => 'required|max:150',
            'site_tagline' => 'max:150',
            'site_logo' => 'file|mimes:jpeg,jpg,png',
            'site_icon' => 'file|mimes:jpeg,jpg,png',
        ]);


        if(!$setting){
            $setting = new General_setting();
        }

        $setting->site_name = $request->site_name;
        $setting->site_title = $request->site_title;
        $setting->site_tagline = $request->site_tagline;
        if($request->has('site_logo')){

            if(Storage::exists($setting->site_logo)){
                Storage::delete($setting->site_logo);
            }
            $logo_path = $request->file('site_logo')->storeAs('admin/setting/files',
            $request->file('site_logo')->getClientOriginalName().time().'.'.$request->file('site_logo')->extension());

            $setting->site_logo = $logo_path;
        }
        if($request->has('site_icon')){
            if(Storage::exists($setting->site_icon)){
                Storage::delete($setting->site_icon);
            }
            $icon_path = $request->file('site_icon')->storeAs('admin/setting/files',
            $request->file('site_icon')->getClientOriginalName().time().'.'.$request->file('site_icon')->extension());

            $setting->site_icon = $icon_path;
        }

        $setting->save();

        Flash_notification::set('General Setting Update Successfully!','success');

        return redirect()->back();
    }

    public function mail_setting_form(){

        $setting = EmailConfig::find(1);

        return view('admin.setting.mail',compact('setting'));
    }

    public function mail_setting_update(Request $request)
    {
        $setting = EmailConfig::find(1);

        $request->validate([
            'mail_host' =>'required',
            'mail_port' => 'required',
            'mail_encryption' =>'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'from_email' =>'required|email',
            'from_name' =>'required',
            'to_email' => 'required',
            'to_name' => 'required'
        ]);

        if(!$setting){
            $setting = new General_setting();
        }

        $setting->mail_host = $request->mail_host;
        $setting->mail_port = $request->mail_port;
        $setting->mail_encryption = $request->mail_encryption;
        $setting->mail_username = $request->mail_username;
        $setting->mail_password = $request->mail_password;
        $setting->from_email = $request->from_email;
        $setting->from_name = $request->from_name;
        $setting->to_email = $request->to_email;
        $setting->to_name = $request->to_name;
        $setting->save();

        Flash_notification::set('Mail Configuration Update Successfully!','success');

        return redirect()->back();
    }

    public function send_test_mail()
    {
        if(config('mail.from.address') && config('mail.receive_to.address')){

            Mail::send(new Test_mail());

            if(Mail::failures()){

                    $response['status'] = 'error';
                    $response['response'] = 'Send test mail failed!';
            }
            else{
                $response['status'] = 'success';
                    $response['response'] = 'Send test mail successfully!';
            }

        }
        else{
            $response['status'] = 'error';
            $response['response'] = 'Add correct from and receiver email address!';
        }


       return response()->json($response);
    }
}
