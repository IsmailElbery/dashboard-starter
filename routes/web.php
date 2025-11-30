<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('items', App\Http\Controllers\ItemController::class)->middleware('auth');

// Public Services Page
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'publicIndex'])->name('services.public');

// Admin Services CRUD
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}', [App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/{service}/edit', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [App\Http\Controllers\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('services.destroy');
});

// Language Switcher
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');
