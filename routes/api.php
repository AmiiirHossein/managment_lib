<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BorrowController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::post('/borrow/{book}', [BorrowController::class, 'borrowBook']);
    Route::post('/return/{book}', [BorrowController::class, 'returnBook']);
    Route::get('/my-books', [BorrowController::class, 'myBorrowedBooks']);
});
