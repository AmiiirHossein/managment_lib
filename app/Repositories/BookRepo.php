<?php


namespace App\Repositories;

use App\Models\Book;

class BookRepo implements BookRepositoryInterface
{

    public function getAll()
    {
        return Book::all();
    }

    public function findById($id)
    {
        return Book::findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        $book = $this->findById($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = $this->findById($id);
        $book->delete();
    }
}
