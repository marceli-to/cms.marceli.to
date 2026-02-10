<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::prefix('dashboard')
	->middleware(['web', 'auth'])
	->group(function () {

		Route::controller(PostController::class)
			->prefix('blog')
			->group(function () {
				Route::get('/', 'index');
				Route::post('/', 'store');
				Route::get('/{post}', 'show');
				Route::put('/{post}', 'update');
				Route::delete('/{post}', 'destroy');
			});

	});
