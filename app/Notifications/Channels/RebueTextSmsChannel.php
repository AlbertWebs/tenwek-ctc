<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class RebueTextSmsChannel
{
    /**
     * Expected notification payload:
     * [
     *   'to' => '+2547...',
     *   'message' => '...'
     * ]
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        if (! method_exists($notification, 'toRebueTextSms')) {
            return;
        }

        $payload = $notification->toRebueTextSms($notifiable);
        if (! is_array($payload)) {
            return;
        }

        $to = $payload['to'] ?? null;
        $message = $payload['message'] ?? null;

        if (! filled($to) || ! filled($message)) {
            return;
        }

        $url = (string) config('sms.rebue_text.api_url');
        $token = (string) config('sms.rebue_text.api_token');
        $senderId = (string) config('sms.rebue_text.sender_id');

        if (! filled($url) || ! filled($token) || ! filled($senderId)) {
            // Misconfigured; fail loudly so admins know why SMS isn't sending.
            throw new RuntimeException('Rebue Text SMS is not configured (SMS_API_URL/SMS_API_TOKEN/SMS_SENDER_ID).');
        }

        Http::timeout(15)
            ->withToken($token)
            ->acceptJson()
            ->post($url, [
                // Rebue Text: keep keys generic; adjust if their API expects different field names.
                'recipient' => $to,
                'message' => $message,
                'sender_id' => $senderId,
            ])
            ->throw();
    }
}

