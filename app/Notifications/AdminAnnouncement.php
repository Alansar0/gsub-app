<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\Channel;


class AdminAnnouncement extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    public $url;

    public function __construct(string $message, ?string $url = null)
    {
        $this->message = $message;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        // database = store in notifications table
        // broadcast = fire real-time event for Echo listeners
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => $this->url,
            'admin' => auth()->user()->full_name ?? auth()->user()->email ?? 'System',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'message' => $this->message,
                'url' => $this->url,
                'admin' => auth()->user()->full_name ?? 'System',
                'created_at' => now()->toDateTimeString(),

            ],
        ]);
    }

    // This ensures broadcasts go to the private channel the frontend listens to.
    public function broadcastOn(): array
{
    return [
        new PrivateChannel('App.Models.User.' . $this->notifiable->id),
    ];
}

}
