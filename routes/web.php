<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/
Route::get('/welcome', ['uses' => 'App\Http\Controllers\WelcomeController@welcome']);
// Homepage Route
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'App\Http\Controllers\WelcomeController@welcome')->name('welcome');
});

// Authentication Routes
Auth::routes();

// Registered and Activated User Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});


// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/users/deleted', \App\Http\Controllers\SoftDeletesController::class, [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', \App\Http\Controllers\UsersManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'App\Http\Controllers\UsersManagementController@search')->name('search-users');

    Route::resource('polls', \App\Http\Controllers\PollsManagementController::class);

    Route::resource('questions', \App\Http\Controllers\QuestionController::class);

});

