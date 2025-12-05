<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AdminController;

// Home page
Route::get('/', function () {
    return view('index');
})->name('home');

// Admin login/logout
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin-only book routes (access checked inside controller)
Route::get('/books/add', [BookController::class, 'addbookform'])->name('book.addform');
Route::post('/books/add', [BookController::class, 'addbook'])->name('book.add');

Route::get('/books/edit/{id}', [BookController::class, 'editbook'])->name('book.editform');
Route::post('/books/update/{id}', [BookController::class, 'updatebook'])->name('book.update');

Route::get('/books/delete/{id}', [BookController::class, 'deletebook'])->name('book.delete');

// Public book listing
Route::get('/books', [BookController::class, 'booklist'])->name('book.list');

// Borrow system
Route::get('/borrow', [BorrowController::class, 'borrowlist'])->name('borrow.list');
Route::get('/borrow/add', [BorrowController::class, 'addborrowform'])->name('borrow.addform'); // optional page
Route::post('/borrow/add', [BorrowController::class, 'addborrow'])->name('borrow.add');
Route::get('/borrow/return/{id}', [BorrowController::class, 'returnbook'])->name('borrow.return');
