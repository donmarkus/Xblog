<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ReceivedComment extends BaseNotification
{
    use Queueable;

    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->enableMail()) {
            return ['database', 'mail'];
        }
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = $this->comment->getCommentableData();
        $email = config('app.email');
        if (!$email)
            $email = $notifiable->email;
        return (new MailMessage)
            ->success()
            ->greeting(trans('xblog.hello') . $notifiable->name)
            ->to($email)
            ->subject(trans('xblog.new_message_received'))
            ->line(trans('xblog.your') . $data['type'] . ':' . $data['title'] . ', 收到了一条来自' . $this->comment->username . '的评论：')
            ->line($this->comment->content)
            ->action('查看', $data['url']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->comment->toArray();
    }
}
