<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\BorrowPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Borrow::class => BorrowPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            return $user->role === UserRole::Admin;
        });
        Gate::define('is-member', function ($user) {
            return $user->role === UserRole::Member;
        });
    }
}
