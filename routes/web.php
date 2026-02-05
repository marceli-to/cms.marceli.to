<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProjectController;

Route::get('/img/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::get('/', LandingController::class)->name('page.landing');

Route::view('/arbeiten', 'pages.works.index')->name('page.works');
Route::get('/arbeiten/{slug}', [ProjectController::class, 'show'])->name('page.works.show');

Route::view('/buero', 'pages.about.index')->name('page.about');
Route::view('/buero/team', 'pages.about.team')->name('page.about.team');
Route::get('/buero/team/{slug}', [App\Http\Controllers\TeamController::class, 'show'])->name('page.about.team.show');
Route::view('/buero/jobs', 'pages.about.jobs')->name('page.about.jobs');
Route::view('/buero/kontakt', 'pages.about.contact')->name('page.about.contact');
Route::view('/buero/netzwerk', 'pages.about.network')->name('page.about.network');
Route::view('/buero/vortraege', 'pages.about.talks')->name('page.about.talks');
Route::view('/buero/jury', 'pages.about.jury')->name('page.about.jury');
Route::view('/buero/auszeichnungen', 'pages.about.awards')->name('page.about.awards');

Route::view('/impressum', 'pages.misc.imprint')->name('page.impressum');
Route::view('/datenschutz', 'pages.misc.privacy')->name('page.datenschutz');

// Dashboard (Vue SPA)
Route::get('/dashboard/{any?}', function () {
    return view('dashboard.layouts.app');
})->where('any', '.*')->name('dashboard');