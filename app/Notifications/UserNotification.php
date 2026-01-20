<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $body;
    protected $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title='',$body='',$link='')
    {
        $this->title=$title;
        $this->body=$body;
        $this->link=$link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title'=>$this->title,
            'body'=>$this->body,
            'link'=>$this->link
        ];
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
            //
        ];
    }
}
