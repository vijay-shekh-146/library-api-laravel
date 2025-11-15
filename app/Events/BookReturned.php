<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Borrowing;

class BookReturned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $borrowing;
    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct(Borrowing $borrowing, $user)
    {
        $this->borrowing = $borrowing;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('borrowing.' . $this->borrowing->id),
        ];
    }
}
