<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/dashboard');
});

// Publicly accessible routes
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::resource('clients', ClientController::class)->only(['index', 'show']);
Route::get('/stats', [ClientController::class, 'stats'])->name('stats');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::post('/search', [SearchController::class, 'search'])->name('search');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Full resource for authenticated users
    Route::resource('clients', ClientController::class)->except(['index', 'show']);

    Route::post('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    Route::resource('informations', InformationController::class)->only('store', 'destroy', 'update');
});

require __DIR__.'/auth.php';
