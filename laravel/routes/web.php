<?php

use App\Facades\Permissions;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/movie/add-to-list', [MovieController::class, 'addToList'])->name('movie.addToList');
    Route::get('/search', [MovieController::class, 'search'])->name('movie.search');
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');

    Route::resource('/movies-list', UserListController::class);
    Route::delete('/movies-list/{user_list_id}/{movie_id}', [UserListController::class, 'removeMovieFromList'])->name('movies-list.removeMovieFromList');

    Route::post('/movie/review', [ReviewController::class, 'store'])->name('review.store');

    Route::post('/movie/review/report-comment/{id}', [CommentController::class, 'reportComment'])->name('comment.report');
    Route::get('/comments/reported-comments', [CommentController::class, 'reportedComments'])->name('comment.reported');
    Route::post('/comments/remove-comment/{id}', [CommentController::class, 'removeComment'])->name('comment.remove');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/facade/test', function () {
    return Permissions::test();
});


require __DIR__.'/auth.php';
