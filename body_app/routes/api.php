<?php

use App\Http\Controllers\HomeController;
use App\Models\Course;
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
Route::post('/login',[HomeController::class,'login']);
Route::post('/calculator',[HomeController::class,'calculator']);
Route::get('/getMealTypes',[HomeController::class,'getMealTypes']);
Route::post('/getFoodRecord',[HomeController::class,'getFoodRecord']);
Route::post('/getFoodParameters',[HomeController::class,'getFoodParameters']);
Route::post('/saveFoodRecord',[HomeController::class,'saveFoodRecord']);
Route::post('/getDashboard',[HomeController::class,'getDashboard']);
Route::post('/changePassword',[HomeController::class,'changePassword']);
Route::post('/changeEmail',[HomeController::class,'changeEmail']);
Route::post('/forgetPassword',[HomeController::class,'forgetPassword']);
Route::post('/resendOtp',[HomeController::class,'resendOtp']);
Route::post('/resetPassword',[HomeController::class,'resetPassword']);
Route::post('/saveWeight',[HomeController::class,'saveWeight']);
Route::post('/activityStatus',[HomeController::class,'activityStatus']);



