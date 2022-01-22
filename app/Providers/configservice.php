<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\admin_setting\EmailConfig;
use App\admin_setting\General_setting;
use Illuminate\Support\Facades\Schema;

class configservice extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if(Schema::hasTable('general_settings') && Schema::hasTable('email_configs')):
        $email_config = EmailConfig::find(1);
        $general_setting = General_setting::find(1);

        if($email_config && $general_setting):
        $this->app['config']['mail'] = [

            'driver' => 'smtp',
              'host' => $email_config->mail_host,
              'port' => $email_config->mail_port,
              'from' => [
                  'address' => $email_config->from_email,
                  'name' => $email_config->from_name
              ],
              'receive_to' => [
                  'address' => $email_config->to_email,
                  'name' => $email_config->to_email
              ],
              'encryption' => $email_config->mail_encryption,
              'username' => $email_config->mail_username,
              'password' => $email_config->mail_password,


        ];

        $this->app['config']['web'] = [
            'name' => $general_setting->site_name,
            'title' => $general_setting->site_title,
            'tagline' => $general_setting->site_tagline,
            'logo' => asset('storage/'.$general_setting->site_logo),
            'icon' => asset('storage/'.$general_setting->site_icon),
        ];

    endif;
endif;
    }
}
