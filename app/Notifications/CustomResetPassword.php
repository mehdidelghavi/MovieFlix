<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $token)
    {
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('panel.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->email,
        ]);
        $content = "<p>برای بازیابی رمز عبور خود روی دکمه زیر کلیک کنید</p>";
        return (new MailMessage)
            ->subject('بازیابی رمز عبور')
            ->view('vendor.email.email', [
                'user' => $notifiable,
                'content' => $content,
                'actionUrl' => $url,
                'actionText' => 'بازیابی رمز عبور'
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
