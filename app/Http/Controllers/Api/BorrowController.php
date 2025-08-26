<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Repositories\BorrowRepositoryInterface;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    private $borrowRepo;
    public function __construct(BorrowRepositoryInterface $borrowRepo)
    {
        $this->borrowRepo = $borrowRepo;
    }
    public function borrowBook(Book $book)
    {
        $this->authorize('borrow', $book);
        $this->borrowRepo->borrowBook(auth()->id(), $book->id);
        $book->update(['is_available' => false]);
        return response()->json(['message' => 'Book borrowed successfully!']);
    }
    public function returnBook(Borrow $borrow)
    {
        $this->authorize('return', $borrow);
        $returned = $this->borrowRepo->returnBook(auth()->id(), $borrow->book_id);
        if ($returned) {
            $borrow->book->update(['is_available' => true]);
            return response()->json(['message' => 'Book returned successfully!']);
        }
        return response()->json(['message' => 'You have not borrowed this book.'], 400);
    }
    public function myBorrowedBooks()
    {
        $this->authorize('viewMyBorrows', Borrow::class);
        $borrowedBooks = $this->borrowRepo->getBorrowedBooksByUser(auth()->id());
        return response()->json($borrowedBooks);
    }
}
