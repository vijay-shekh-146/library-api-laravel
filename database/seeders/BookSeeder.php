<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Book 1',
                'author' => 'Author 1',
                'description' => 'Description 1',
            ],
            [
                'title' => 'Book 2',
                'author' => 'Author 2',
                'description' => 'Description 2',
            ],
            [
                'title' => 'Book 3',
                'author' => 'Author 3',
                'description' => 'Description 3',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
