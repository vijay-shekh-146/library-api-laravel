<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

// Route::get('/roles', [AuthController::class, 'getRoles']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
     Route::post('/refresh', [AuthController::class, 'refresh']);

    // Book routes
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);

    Route::middleware('role:Admin')->group(function () {
        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);
    });

    // Borrowing routes
    Route::get('/my-borrowings', [BorrowingController::class, 'myBorrowings']);
    Route::post('/books/{id}/borrow', [BorrowingController::class, 'borrowBook']);
    Route::post('/books/{id}/return', [BorrowingController::class, 'returnBook']);
});
