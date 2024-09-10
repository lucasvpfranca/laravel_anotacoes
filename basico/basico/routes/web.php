<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Main;
use App\Http\Controllers\MainController;
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

Route::get('/login', [AuthController::class, 'login']);
Route::post('loginSubmit', [AuthController::class, 'loginSubmit']);

Route::get("logout", [AuthController::class, 'logout']);
