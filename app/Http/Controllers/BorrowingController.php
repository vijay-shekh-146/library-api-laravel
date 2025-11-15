<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use App\Events\BookBorrowed; 
use App\Events\BookReturned;


class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/books/{book_id}/borrow",
     *     tags={"Borrowing"},
     *     summary="Borrow a book by ID",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="book_id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to borrow",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Book borrowed successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Book is unavailable or already borrowed"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function borrowBook($bookId)
    {
        $book = Book::find($bookId);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Book not found'], 404);
        }

        if ($book->status === 'borrowed') {
            return response()->json(['success' => false, 'message' => 'Book is not available'], 400);
        }

         // Check if user already borrowed this book
        $alreadyBorrowed = Borrowing::where('book_id', $bookId)
            ->where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->exists();
            
        if ($alreadyBorrowed) {
            return response()->json(['success' => false, 'message' => 'You have already borrowed this book'], 400);
        }

        $borrowing = Borrowing::create([
            'book_id' => $bookId,
            'user_id' => Auth::id(),
            'borrowed_at' => now(),
        ]);

        $book->update(['status' => 'borrowed']);

        // Dispatch book borrowed event
        Event::dispatch(new BookBorrowed($borrowing, Auth::user()));
        
        return response()->json([
            'success' => true,
            'message' => 'Book borrowed successfully',
            'data' => $book
        ]);
    }


    /**
     * @OA\Post(
     *     path="/api/books/{book_id}/return",
     *     tags={"Borrowing"},
     *     summary="Return a borrowed book by ID",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="book_id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to return",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Book returned successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Borrowing record not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Book is not borrowed by this user"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function returnBook($bookId)
    {
        $borrowing = Borrowing::where('book_id', $bookId)
            ->where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->first();

        if (!$borrowing) {
            return response()->json([
                'success' => false,
                'message' => 'No active borrowing found for this book'
            ], 404);
        }

        // Update borrowing record
        $borrowing->update(['returned_at' => now()]);

        // Update book availability
        $book = Book::find($bookId);
        $book->status = 'available';
        $book->save();

        // Dispatch event (optional)
        Event::dispatch(new BookReturned($borrowing, Auth::user()));

        return response()->json([
            'success' => true,
            'message' => 'Book returned successfully',
            'data' => $borrowing
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/my-borrowings",
     *     tags={"Borrowing"},
     *     summary="Get all borrowings of the logged-in user",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of borrowings"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function myBorrowings()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $borrowings
        ]);
    }
}
