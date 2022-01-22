<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Accept_bid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $bid;
    public function __construct($bid)
    {
        $this->bid = $bid;
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
            $prefer_mail = $notifiable->notification_setting->acceptbid_notification;
        }
        else{
            $prefer_mail = 0;
        }
        return $prefer_mail ? ['mail', 'database', 'broadcast'] : ['database','broadcast'];
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
        ->subject('Accept Project bid')
        ->markdown('emails.notification.accept-bid',['bid'=>$this->bid]);
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
            'user'=>$this->bid->project->user,
            'msg'=>$this->bid->project->user.' accept your project bid',
            'type'=>'accept_bid',
            'project'=>$this->bid->project
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user'=>$this->bid->project->user,
            'msg'=>$this->bid->project->user.' accept your project bid',
            'type'=>'accept_bid',
            'project'=>$this->bid->project
        ]);
    }
}
