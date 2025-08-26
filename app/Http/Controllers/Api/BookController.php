<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Repositories\BookRepositoryInterface;

class BookController extends Controller
{
    private $bookRepo;
    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->bookRepo = $bookRepo;
        $this->authorizeResource(Book::class, 'book');
    }
    public function index() { return BookResource::collection($this->bookRepo->getAll()); }
    public function show(Book $book) { return new BookResource($this->bookRepo->findById($book->id)); }
    public function store(StoreBookRequest $request)
    {
        $book = $this->bookRepo->create($request->validated());
        return new BookResource($book);
    }
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book = $this->bookRepo->update($book->id, $request->validated());
        return new BookResource($book);
    }
    public function destroy(Book $book)
    {
        $this->bookRepo->delete($book->id);
        return response()->json(null, 204);
    }
}
