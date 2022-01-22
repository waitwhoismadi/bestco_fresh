<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use phpDocumentor\Reflection\Types\This;

class FeedComment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $sender;
     public $feed;

    public function __construct($sender, $feed)
    {
        $this->sender = $sender;
        $this->feed = $feed;
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
            $prefer_mail = $notifiable->notification_setting->feedcomment_notification;
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
        ->subject('New Comment on your feed')
        ->markdown('emails.notification.feed-comment',['notify' => $notifiable,'sender'=>$this->sender,'feed'=>$this->feed]);
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
            'msg'=>$this->sender->name.' add new comment on your feed',
            'type'=>'feed_comment',
            'feed'=>$this->feed
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user'=>$this->sender,
            'msg'=>$this->sender->name.' add new comment on your feed',
            'type'=>'feed_comment',
            'feed'=>$this->feed
        ]);
    }
}
