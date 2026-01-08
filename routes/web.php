<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/img/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::view('/', 'landing')->name('page.landing');

Route::view('/home', 'home')->name('page.home');
Route::view('/inner', 'inner')->name('page.inner');
Route::view('/show', 'show')->name('page.show');
Route::view('/works', 'works')->name('page.works');
