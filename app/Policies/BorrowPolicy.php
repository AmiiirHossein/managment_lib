<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Borrow;
use Illuminate\Auth\Access\HandlesAuthorization;

class BorrowPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->can('is-admin')) {
            return true;
        }
    }

    // کاربری که قرض گرفته فقط می‌تونه برگردونه
    public function return(User $user, Borrow $borrow)
    {
        return $borrow->user_id === $user->id;
    }

    public function viewMyBorrows(User $user)
    {
        return true;    }
}
