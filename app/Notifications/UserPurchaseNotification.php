<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Morilog\Jalali\Jalalian;

class UserPurchaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $payment, public $plan)
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
        $content = "<p> این یک رسید برای فاکتور {$this->payment->payment_number} است که در تاریح " . Jalalian::forge($this->payment->created_at)->format('%A, %d %B %Y | H:i:s') . " ارسال شده است</p>
            <p dir='rtl'>جزییات پرداخت شما به شرح زیر میباشد<br>
            ------------------------------<wbr>------------------------<br>
            مبلغ پرداختی: {$this->plan->price } تومان<br>
            نام تعرفه : {$this->plan->title}<br>
            زمان تعرفه : {$this->plan->duration} روزه <br>
            </p>";
        return (new MailMessage)
            ->subject('پرداخت الکترونیکی')
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
