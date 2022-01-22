<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Followrequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $sender;

    public function __construct($sender)
    {
        $this->sender = $sender;
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
            $prefer_mail = $notifiable->notification_setting->request_notification;
        }
        else{
            $prefer_mail = 0;
        }
        return $prefer_mail ? ['mail', 'database', 'broadcast'] : ['database', 'broadcast'];
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
        ->subject('Follow Request')
        ->markdown('emails.notification.follow-request',['notify' => $notifiable,'sender'=>$this->sender]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user'=>$this->sender,
            'msg'=>$this->sender->name.' sent you a follow request',
            'type'=>'follow_request'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user'=>$this->sender,
            'msg'=>$this->sender->name.' sent you a follow request',
            'type'=>'follow_request'
        ]);
    }
}
