<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class Send_msg extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($notifiable->notification_setting){
            $prefer_mail = $notifiable->notification_setting->message_notification;
        }
        else{
            $prefer_mail = 0;
        }
        return $prefer_mail ? ['mail', 'database'] : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('New message')
        ->markdown('emails.notification.Send_msg',['notify'=>$notifiable,'sender'=>auth()->user()]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user'=>auth()->user(),
            'msg'=>auth()->user()->name.' send a new message',
            'type'=>'send_msg',

        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user'=>auth()->user(),
            'msg'=>auth()->user()->name.' send a new message',
            'type'=>'send_msg',

        ]);
    }
}
