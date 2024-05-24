<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\IndividualsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


Route::group(['middleware' => ['auth:api', 'jwt.verify']], function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/daily_notification/update', [UserController::class, 'updateNotificationStatus']);
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::get('/individuals', [IndividualsController::class, 'index']);
    Route::get('/individuals/{id}', [IndividualsController::class, 'show']);
});