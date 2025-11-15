<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
    ];

    // A borrowing belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A borrowing belongs to a book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
