<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'index'])->name('api.users');
Route::post('users', [UserController::class, 'create'])->name('api.users.create');


Route::delete('users/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
Route::delete('users/batch/{ids}', [UserController::class, 'destroyBatch'])->name('api.users.batch.destroy');
Route::put('users/{user}', [UserController::class, 'update'])->name('api.users.update');
