<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->can('is-admin')) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }
    public function view(User $user, Book $book) { return true; }

    public function create(User $user)
    {
        return $user->can('is-admin');
    }
    public function update(User $user, Book $book)
    {
        return $user->can('is-admin');
    }
    public function delete(User $user, Book $book)
    {
        return $user->can('is-admin');
    }

    public function borrow(User $user, Book $book)
    {
        return (bool) $book->is_available;
    }
}
