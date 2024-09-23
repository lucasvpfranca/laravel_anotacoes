<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Main;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Auth\Events\Logout;
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

Route::middleware([CheckIsNotLogged::class])->group(function() {

    Route::get('/login', [AuthController::class, 'login']);
Route::post('loginSubmit', [AuthController::class, 'loginSubmit']);


});



Route::middleware([CheckIsLogged::class])->group(function () {

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('newNote');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get("logout", [AuthController::class, 'logout'])->name('logout');
});

