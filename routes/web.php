<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Http\Controllers\GameController;

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

Route::get('/', [GameController::class, 'index'])->name('game.index');
Route::get('/game/{game:game_code}', [GameController::class, 'gameStart'])->name('game.start');
Route::get('/socket', function () {
    return view('testsocket');
});
