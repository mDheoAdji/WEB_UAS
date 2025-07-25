<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

//Halaman Utama
Route::get('/', [LandingController::class, 'index'])->name('landing');

//Detail Berita per Slug
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

//Detail Penulis
Route::get('/author/{username}', [AuthorController::class, 'show'])->name('author.show');

//Kategori Berita per Slug (pindahkan ke bawah agar tidak bentrok dengan /news/{slug})
Route::get('/category/{slug}', [NewsController::class, 'category'])->name('news.category');

Route::get('/search', [NewsController::class, 'search'])->name('news.search');

