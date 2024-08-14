<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthorController::class)->group(function () {
    Route::get('authors', 'index');
    Route::get('authors/{id}', 'show');
    Route::get('authors/{id}/books', 'books');
});

Route::controller(BookController::class)->group(function () {
    Route::get('books', 'index');
    Route::get('books/{id}', 'show');
});

// Route::get('authors', AuthorController::class);
// Route::get('authors/{id}', [AuthorController::class, 'show']);
// Route::get('books', BookController::class);
// Route::get('authors/{id}/books', [AuthorController::class, 'books']);