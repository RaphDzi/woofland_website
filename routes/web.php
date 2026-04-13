<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Publication;
use App\Http\Controllers\PublicationController;




Route::get('/', function () {
    $publications = Publication::latest()->get();

    return view('welcome', compact('publications'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/publications/{publication}', [PublicationController::class, 'show'])
    ->name('publications.show');

Route::get('/actualites', function () {

    $publications = Publication::with('formateur')
        ->orderBy('created_at', 'desc')
        ->paginate(9);

    return view('publications.index', compact('publications'));
})->name('publications.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/2fa', [TwoFactorController::class, 'form'])->name('2fa.form');
Route::post('/2fa', [TwoFactorController::class, 'verify'])->name('2fa.verify');

require __DIR__ . '/auth.php';
