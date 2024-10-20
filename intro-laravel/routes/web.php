<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowsController;
use App\Http\Controllers\BorrowersController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'home']);

Route::get('/register', [AuthController::class, 'register']);

Route::get('/welcome', [AuthController::class, 'welcome']);

Route::post('/welcome', [AuthController::class, 'post']);

Route::get('/table', [DashboardController::class, 'table']);

Route::get('/data-table', [DashboardController::class, 'data_table']);

// Auth::routes();

Route::middleware(['auth'])->group(function () {
    // CRUD Categories with Auth Route
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

    // CRUD Books Route
    Route::resource('books', BooksController::class)
        ->names([
            // 'index' => 'books.index',
            'create' => 'books.create',
            'store' => 'books.store',
            // 'show' => 'books.show',
            'edit' => 'books.edit',
            'update' => 'books.update',
            'destroy' => 'books.destroy',
        ]);

    // CRUD Borrows Route
    Route::resource('borrows', BorrowsController::class)
        ->names([
            'index' => 'borrows.index',
            'create' => 'borrows.create',
            'store' => 'borrows.store',
            'show' => 'borrows.show',
            'edit' => 'borrows.edit',
            'update' => 'borrows.update',
            'destroy' => 'borrows.destroy',
        ]);

    Route::get('/borrows/return/{id}', [BorrowsController::class, 'return'])->name('borrows.return');

    // CRUD Borrowers Route
    Route::resource('borrowers', BorrowersController::class)
        ->names([
            'index' => 'borrowers.index',
            'create' => 'borrowers.create',
            'store' => 'borrowers.store',
            'show' => 'borrowers.show',
            'edit' => 'borrowers.edit',
            'update' => 'borrowers.update',
            'destroy' => 'borrowers.destroy',
        ]);
});

// CRUD Categories No Auth Route
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('categories.show');

// CRUD Books No Auth Route
Route::resource('books', BooksController::class) // it will generate all the routes for the books controller
    ->names([
        'index' => 'books.index',
        'show' => 'books.show',
    ]);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
