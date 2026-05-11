<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Morilog\Jalali\Jalalian;

class UserPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        $content = '<p>شما در تاریخ ' . Jalalian::now()->format('%A, %d %B %Y | H:i:s') . ' اقدام به بازیابی رمز عبور خود کرده اید</p>';
        return (new MailMessage)
            ->subject('بازیابی رمز عبور')
            ->view('vendor.email.email', [
                'user' => $notifiable,
                'content' => $content,
                'actionUrl' => url('/panel'),
                'actionText' => 'ورود به پنل کاربری'
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
