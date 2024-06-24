<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoneyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CollectionController;




Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

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
