<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/accueil', function () { return view('accueil');} )->middleware(['auth', 'verified'])->name('accueil');
Route::get("/accueil",[AccueilController::class,'index'])->middleware(['auth', 'verified'])->name('accueil');

Route::post('/validate-pattern', [PatternController::class, 'validatePattern']);
Route::patch('/gagner-str',[PatternController::class,'gagnerstr'])->name('gagner-str');
Route::patch('/perdre-str',[PatternController::class,'perdrestr'])->name('perdre-str');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
