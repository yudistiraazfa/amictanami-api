<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth Routes (RESTful & Legacy .php aliases for Android App)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register.php', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login.php', [AuthController::class, 'login']);

Route::post('/forgot_password.php', [ForgotPasswordController::class, 'sendCode']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendCode']);

Route::post('/verify_code.php', [ForgotPasswordController::class, 'verifyCode']);
Route::post('/verify-code', [ForgotPasswordController::class, 'verifyCode']);

Route::post('/reset_password.php', [ForgotPasswordController::class, 'resetPassword']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

// Profile Routes
use App\Http\Controllers\ProfileController;

Route::post('/get_profile.php', [ProfileController::class, 'show']);
Route::post('/profile', [ProfileController::class, 'show']);

Route::post('/update_profile.php', [ProfileController::class, 'update']);
Route::put('/profile', [ProfileController::class, 'update']);

// Plant Directory Routes (RESTful + Backwards Compatible Legacy URLs)
use App\Http\Controllers\PlantController;

Route::get('/get_all_tanaman.php', [PlantController::class, 'index']);
Route::get('/plants', [PlantController::class, 'index']);

Route::get('/get_tanaman_by_id.php', [PlantController::class, 'show']);
Route::get('/plants/{id}', [PlantController::class, 'show']);

Route::get('/get_tanaman_by_kategori.php', [PlantController::class, 'byCategory']);
Route::get('/plants/category/{kategori_id}', [PlantController::class, 'byCategory']);

Route::get('/search_tanaman.php', [PlantController::class, 'search']);
Route::get('/plants/search', [PlantController::class, 'search']);

Route::get('/get_detail_tanaman.php', [PlantController::class, 'detail']);
Route::get('/plants/{id}/detail', [PlantController::class, 'detail']);

// Activity Logs Routes
use App\Http\Controllers\ActivityLogController;

Route::post('/add_log.php', [ActivityLogController::class, 'store']);
Route::post('/logs', [ActivityLogController::class, 'store']);

Route::post('/get_logs.php', [ActivityLogController::class, 'index']);
Route::get('/logs/{user_id}', [ActivityLogController::class, 'index']);

// TanamCare History Routes
use App\Http\Controllers\TanamCareHistoryController;

Route::post('/add_tanamcare_history.php', [TanamCareHistoryController::class, 'store']);
Route::post('/tanamcare-history', [TanamCareHistoryController::class, 'store']);

Route::post('/get_tanamcare_history.php', [TanamCareHistoryController::class, 'index']);
Route::get('/tanamcare-history/{user_id}', [TanamCareHistoryController::class, 'index']);
