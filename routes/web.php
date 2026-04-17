<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Publication;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\Admin\AdminCoursController as AdminCoursController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\AdminUserController as AdminUserController;



// default page
Route::get('/', function () {
    $publications = Publication::latest()->get();

    return view('welcome', compact('publications'));
});

// about page
Route::get('/about', function () {
    return view('about');
})->name('about');

//2FA routes
Route::get('/2fa', function () {
    return view('auth.two-factor');
});
Route::post('/2fa', [TwoFactorController::class, 'verify'])->name('2fa.verify');

// Publications routes
Route::get('/publications/{publication}', [PublicationController::class, 'show'])
    ->name('publications.show');

Route::get('/actualites', function () {

    $publications = Publication::with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(9);

    return view('publications.index', compact('publications'));
})->name('publications.index');

// dashboard page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// profile routes
Route::middleware('auth')->group(function () {

    //PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //PROFILE ADRESS
    Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.address.update');
    //PROFILE DOG
    Route::post('/profile/dog', [ProfileController::class, 'storeDog'])->name('profile.dog.store');
    Route::patch('/profile/dog/{id}', [ProfileController::class, 'updateDog'])->name('profile.dog.update');
    Route::delete('/profile/dog/{id}', [ProfileController::class, 'deleteDog'])->name('profile.dog.delete');
});

// cours routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cours', [CoursController::class, 'index'])->name('cours.index');

    Route::post('/cours/{id}/inscription', [CoursController::class, 'inscrire'])->name('cours.inscrire');

    Route::delete('/cours/{id}/desinscription', [CoursController::class, 'desinscrire'])->name('cours.desinscrire');
});

//message routes
Route::middleware(['auth'])->group(function () {

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');

    Route::post('/messages/send', [MessageController::class, 'store'])->name('messages.store');

    Route::post('/conversations/start/{userId}', [MessageController::class, 'start'])
    ->middleware('auth')
    ->name('conversations.start');
});

// admin routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('/cours', AdminCoursController::class);

        Route::resource('/publications', AdminPublicationController::class);

        Route::resource('/users', AdminUserController::class);

    });

// auth routes
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

require __DIR__ . '/auth.php';
