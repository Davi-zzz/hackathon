<?php

use App\Http\Resources\TransparencyService;

use App\Http\Controllers\TransparencyController;
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

Route::prefix('transparency')->group(function () {
    Route::get('/', [TransparencyController::class, 'index']);
    Route::get('/results', [TransparencyController::class, 'webScrapingResult'])->name('transparency.results');
    Route::get('/testes', [TransparencyController::class, 'testes']);
   });
