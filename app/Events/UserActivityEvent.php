<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActivityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var App\Models\User
     */
    public $user;

    /**
     * @var string
     */
    public $ip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $ip)
    {
        $this->user = $user;
        $this->ip   = $ip;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
    }
}
