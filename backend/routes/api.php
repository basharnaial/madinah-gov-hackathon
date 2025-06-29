<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Api\TimelineStepController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registration routes
Route::prefix('registration')->group(function () {
    Route::post('/register', [RegistrationController::class, 'register']);
    Route::get('/field-of-interest-options', [RegistrationController::class, 'getFieldOfInterestOptions']);
    Route::get('/registration-type-options', [RegistrationController::class, 'getRegistrationTypeOptions']);
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Auth routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:admin');
    
    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        
        // Participant management
        Route::prefix('participants')->group(function () {
            Route::get('/', [ParticipantController::class, 'index']);
            Route::get('/{participant}', [ParticipantController::class, 'show']);
            Route::post('/{participant}/approve', [ParticipantController::class, 'approve']);
            Route::post('/{participant}/reject', [ParticipantController::class, 'reject']);
            Route::get('/{participant}/cv', [ParticipantController::class, 'downloadCv']);
            Route::get('/export/excel', [ParticipantController::class, 'exportToExcel']);
        });
        
        // Dashboard statistics
        Route::get('/dashboard/stats', [ParticipantController::class, 'getStats']);
        
        // Timeline Steps management
        Route::prefix('timeline-steps')->group(function () {
            Route::get('/', [TimelineStepController::class, 'index']);
            Route::post('/', [TimelineStepController::class, 'store']);
            Route::get('/{id}', [TimelineStepController::class, 'show']);
            Route::put('/{id}', [TimelineStepController::class, 'update']);
            Route::delete('/{id}', [TimelineStepController::class, 'destroy']);
        });
    });
});

// Public routes
Route::get('/timeline-steps', [TimelineStepController::class, 'index']);
