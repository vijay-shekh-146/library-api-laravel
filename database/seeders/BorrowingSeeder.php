<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereHas('role', fn($q) => $q->where('name', 'User'))->get();
        $books = Book::all();
        foreach ($users as $user) {
            Borrowing::create([
                'user_id' => $user->id,
                'book_id' => $books->random()->id,
                'borrowed_at' => Carbon::now()->subDays(rand(1, 10))
            ]);
        }

    }
}
