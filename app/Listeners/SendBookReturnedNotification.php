<?php

namespace App\Listeners;

use App\Events\BookReturned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendBookReturnedNotification
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookReturned $event): void
    {
        $borrowing = $event->borrowing;
        $bookTitle = $borrowing->title ?? 'Unknown';
        $userName = $event->user->name;

        // Simulate sending a notification (here via logging)
        Log::info("Book returned: '{$bookTitle}' by user name {$userName}");
    }
}
