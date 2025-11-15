<?php

namespace App\Listeners;

use App\Events\BookBorrowed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookBorrowedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendBookBorrowedNotification
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
    public function handle(BookBorrowed $event): void
    {
        $borrowing = $event->borrowing;
        $user = $event->user;
        //Log::info(json_encode($event));
        Log::info("Book borrowed: {$borrowing->title} by user name: {$user->name}");

         // You could also send mail or notification here
        // Mail::to($event->user->email)->send(new BookBorrowedNotification($event->book, $event->user));
    }
}
