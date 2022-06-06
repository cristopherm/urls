<?php

use App\Http\Controllers\UrlController;
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
*/

Route::get('/', fn () => redirect()->route('login'));

Route::group(['middleware' => ['auth']], function () {
    // Url routes.
    Route::prefix('urls')->group(function () {
        Route::get('', [UrlController::class, 'index'])->name('urls.index');
        Route::get('create', [UrlController::class, 'create'])->name('urls.create');
        Route::post('', [UrlController::class, 'store'])->name('urls.store');
        Route::get('{url}', [UrlController::class, 'show'])->name('urls.show');
        Route::get('{log}/body', [UrlController::class, 'showBody'])->name('urls.show_body');
        Route::get('{url}/edit', [UrlController::class, 'edit'])->name('urls.edit');
        Route::put('{url}', [UrlController::class, 'update'])->name('urls.update');
        Route::delete('{url}', [UrlController::class, 'destroy'])->name('urls.destroy');
    });
});

require __DIR__.'/auth.php';
