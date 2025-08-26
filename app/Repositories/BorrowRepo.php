<?php


namespace App\Repositories;

use App\Models\Borrow;

class BorrowRepo implements BorrowRepositoryInterface
{
    public function borrowBook($userId, $bookId)
    {
        return Borrow::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'borrowed_at' => now(),
        ]);
    }

    public function returnBook($userId, $bookId)
    {
        $borrow = $this->isBookBorrowedByUser($userId, $bookId);
        if ($borrow) {
            $borrow->update(['returned_at' => now()]);
            return true;
        }
        return false;
    }

    public function getBorrowedBooksByUser($userId)
    {
        return Borrow::with('book')->where('user_id', $userId)->whereNull('returned_at')->get();
    }

    public function isBookBorrowedByUser($userId, $bookId)
    {
        return Borrow::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->first();
    }
}
