<?php

namespace App\Notifications;

use App\Notifications\Channels\RebueTextSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminTwoFactorCodeNotification extends Notification
{
    use Queueable;

    /**
     * @param  array<int, string>  $channels
     */
    public function __construct(
        public readonly string $code,
        public readonly array $channels,
    ) {
    }

    /**
     * @param  mixed  $notifiable
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return array_map(function (string $channel) {
            return $channel === 'rebueTextSms' ? RebueTextSmsChannel::class : $channel;
        }, $this->channels);
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Tenwek CTC admin verification code')
            ->line('Your verification code is: ' . $this->code)
            ->line('This code expires in 10 minutes.')
            ->line('If you did not attempt to log in, you can ignore this email.');
    }

    /**
     * Used by the custom Rebue Text notification channel.
     *
     * @return array{to: string|null, message: string}
     */
    public function toRebueTextSms($notifiable): array
    {
        return [
            'to' => $notifiable->routeNotificationFor('rebueTextSms', $this) ?? null,
            'message' => 'Tenwek CTC admin code: ' . $this->code . '. Expires in 10 minutes.',
        ];
    }
}

