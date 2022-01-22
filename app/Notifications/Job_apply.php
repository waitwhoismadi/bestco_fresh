<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Job_apply extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $apply_job;
     public $sender;

    public function __construct($apply_job,$sender)
    {
       $this->apply_job = $apply_job;
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
            $prefer_mail = $notifiable->notification_setting->jobapply_notification;
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
        ->subject('Apply Job')
        ->markdown('emails.notification.job-apply',['notify'=>$notifiable,'sender'=>$this->sender,'apply_job'=>$this->apply_job]);
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
            'msg'=>$this->sender->name.' apply your job',
            'type'=>'job_apply',
            'job'=>$this->apply_job->job
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user'=>$this->sender,
            'msg'=>$this->sender->name.' apply your job',
            'type'=>'job_apply',
            'job'=>$this->apply_job->job
        ]);
    }
}
