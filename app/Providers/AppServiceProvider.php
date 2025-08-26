<?php

namespace App\Providers;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\BookRepo;
use App\Repositories\BorrowRepositoryInterface;
use App\Repositories\BorrowRepo;
use Illuminate\Support\ServiceProvider;
use App\Policies\BookPolicy;
use App\Models\Borrow;
use App\Policies\BorrowPolicy;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepo::class);
        $this->app->bind(BorrowRepositoryInterface::class, BorrowRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
