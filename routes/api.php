<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoneyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CollectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get("/{userId}", [MoneyController::class, "show"]);

Route::post("/", [MoneyController::class, "store"]);

Route::post("/{cedulaId}", [MoneyController::class, "changeToMarcketplace"]);

Route::get("/", [MoneyController::class, "index"]);

Route::post('/login/login', [UserController::class, 'login']);

Route::post('/login/register', [UserController::class, 'register']);

Route::post('/login/forgotpassword', [UserController::class, 'forgotpassword']);

Route::post('/login/resetpassword', [UserController::class, 'resetpassword']);

Route::post('/login/logout', [UserController::class, 'logout']);

Route::get('/login/check-auth', [UserController::class, 'checkAuth']);

Route::get('/collection/{userId}/all', [CollectionController::class, 'index']);

Route::post('/collection/{userId}/add', [CollectionController::class, 'store']);

Route::get('/collection/{userId}/{collectionId}', [CollectionController::class, 'show']);
Route::post('/collection/{userId}/{collectionId}/edit', [CollectionController::class, 'edit']);








Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
