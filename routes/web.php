<?php

use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookshelfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Route::get('/role', function () {
    //     return view('welcome');
    // })->middleware(['role:mahasiswa']);
    Route::view('/roles', 'role')->name('role')->middleware(['role:mahasiswa']);
    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'bookshelf',
        'as' => 'bookshelf.'
    ],function(){
        Route::get('/', [BookshelfController::class, 'index'])->name('index');
        Route::get('/create', [BookshelfController::class, 'create'])->name('create');
        Route::post('/store', [BookshelfController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BookshelfController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BookshelfController::class, 'update'])->name('update');
        Route::delete('/books/{id}', [BookshelfController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
