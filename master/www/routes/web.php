<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterClassController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/cabinet', function () {
        return view('cabinet');
    })->name('cabinet');

    Route::middleware('role:visitor')->group(function () {
        Route::post('/register/{id}', [MasterClassController::class, 'register'])->name('masterclass.register');
        Route::delete('/register/{id}/cancel', [MasterClassController::class, 'cancelRegister'])
            ->name('register.cancel');
    });

    Route::middleware('role:teacher')->group(function () {
        Route::get('/api/unavailable-slots', [MasterClassController::class, 'getUnavailableSlots'])->name('api.unavailable-slots');

        Route::get('/masterclass/create', [MasterClassController::class, 'create'])->name('masterclass.create');
        Route::post('/masterclass/create', [MasterClassController::class, 'store'])->name('masterclass.store');

        Route::get('/masterclass/{id}', [MasterClassController::class, 'edit'])->name('masterclass.update.form');
        Route::put('/masterclass/{id}', [MasterClassController::class, 'update'])->name('masterclass.update');
        Route::delete('/masterclass/{id}', [MasterClassController::class, 'destroy'])->name('masterclass.destroy');
    });
});
