<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Post_bid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $project_bid;
     public $sender;

    public function __construct($project_bid, $sender)
    {
        $this->project_bid = $project_bid;
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
            $prefer_mail = $notifiable->notification_setting->projectbid_notification;
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
        ->subject('Post new bid')
        ->markdown('emails.notification.post-bid',['notify'=>$notifiable,'sender'=>$this->sender,'project_bid'=>$this->project_bid]);
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
            'msg'=>$this->sender->name.' post a bid on your project',
            'type'=>'post_bid',
            'project'=>$this->project_bid->project

        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user'=>$this->sender,
            'msg'=>$this->sender->name.' post a bid on your project',
            'type'=>'post_bid',
            'project'=>$this->project_bid->project

        ]);
    }
}
