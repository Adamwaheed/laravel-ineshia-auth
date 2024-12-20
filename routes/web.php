<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group([], function () {
    Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies.index');
//
//    Route::get('/vacancies/create', [VacancyController::class, 'create'])->name('vacancies.create');
//    Route::post('/vacancies', [VacancyController::class, 'store'])->name('vacancies.store');
//    Route::get('/vacancies/{vacancy}', [VacancyController::class, 'show'])->name('vacancies.show');
//    Route::get('/vacancies/{vacancy}/edit', [VacancyController::class, 'edit'])->name('vacancies.edit');
//    Route::put('/vacancies/{vacancy}', [VacancyController::class, 'update'])->name('vacancies.update');
//    Route::delete('/vacancies/{vacancy}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');
});


Route::get('/dashboard', function () {
    $name = 'John Doe';

    return Inertia::render('Dashboard',['name' => $name]);

})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
