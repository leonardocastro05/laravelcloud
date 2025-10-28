<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\BookReviewController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\UserController;

// RUTES PER USUARIS AUTENTICATS
Route::middleware('auth')->group(function () {

    // '/' → redirigeix a dashboard si està loguejat
    Route::get('/dashboard', function () {
        return redirect()->route('bookshelf.index');
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bookshelf', [BookshelfController::class, 'index'])->name('bookshelf.index');
    Route::get('/bookshelf/show/{id}', [BookshelfController::class, 'show'])->name('bookshelf.show');

    Route::post('/bookshelf/{book}/review', [BookReviewController::class, 'store'])->name('bookshelf.review');

    Route::middleware(['admin'])->group(function () {

        // Book Crud
        Route::get('/bookshelf/create', [BookshelfController::class, 'create'])->name('bookshelf.create');
        Route::post('/bookshelf/store', [BookshelfController::class, 'store'])->name('bookshelf.store');
        Route::get('/bookshelf/edit/{id}', [BookshelfController::class, 'edit'])->name('bookshelf.edit');
        Route::put('/bookshelf/update/{id}', [BookshelfController::class, 'update'])->name('bookshelf.update');
        Route::delete('/bookshelf/{id}', [BookshelfController::class, 'destroy'])->name('bookshelf.destroy');


        // Categorie Crud
        Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::post('/categories/store', [CategorieController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');


        // Users Crud
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// RUTES PER VISITANTS (NO autenticats)
Route::middleware('guest')->group(function () {
    // '/' → mostra welcome (que és login)
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});

require __DIR__ . '/auth.php';
