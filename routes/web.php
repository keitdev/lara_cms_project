<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/*---------------***************FRONT ROUTES******************------------------*/
Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});

/*---------------***************ADMIN ROUTES******************------------------*/
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function() {
    Route::resource('dashboard', DashboardController::class)->only([
        'index'
    ]);
    Route::resources([
        'post' => PostController::class,
        'tag' => TagController::class,
        'categorie' => CategorieController::class,
        'page' => PageController::class,
        'comment' => CommentController::class,
        'user' => UserController::class,
    ]);
});
