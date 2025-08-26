<?php

namespace App\Repositories;

use App\Models\Borrow;

interface BorrowRepositoryInterface
{
    public function borrowBook($userId, $bookId);

    public function returnBook($userId, $bookId);

    public function getBorrowedBooksByUser($userId);

    public function isBookBorrowedByUser($userId, $bookId);
}
