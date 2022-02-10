<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

Route::get('/', [PagesController::class, 'index']);
Route::resource('/blog', PostController::class);
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [PostController::class, 'blog']);
Route::get('/panel', [PostController::class, 'panel'])->name('blog.panel');
Route::get('/trash', [PostController::class, 'trash'])->name('blog.trash');
Route::get('/users', [PostController::class, 'users'])->name('blog.users');
Route::get('/restore', [PostController::class, 'restore'])->name('blog.restore');
Route::get('/restore/{id}', [PostController::class, 'restore'])->name('blog.restore');
Route::delete('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('blog.force-delete');
Route::delete('/user-delete/{id}', [PostController::class, 'userDelete'])->name('blog.user-delete');
