<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Register
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    // Users routes
    Route::get('users', [UserController::class, 'index'] );
    Route::post('users', [UserController::class, 'store'] );
    Route::get('users/{id}', [UserController::class, 'show'] );
    Route::post('users/{id}', [UserController::class, 'update'] );
    Route::delete('users/{id}', [UserController::class, 'destroy'] );

    // Certificates routes
    Route::post('certificates', [CertificateController::class, 'store'] );
    Route::post('certificates/{id}', [CertificateController::class, 'update'] );
    Route::delete('certificates/{id}', [CertificateController::class, 'destroy'] );

    // Projects routes
    Route::post('projects', [ProjectController::class, 'store'] );
    Route::post('projects/{id}', [ProjectController::class, 'update'] );
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'] );

    // Mails routes
    Route::get('mails', [MailController::class, 'index'] );
    Route::get('mails/{id}', [MailController::class, 'show'] );
    Route::delete('mails/{id}', [MailController::class, 'destroy'] );
});


//Public routes
// Certificates routes
Route::get('certificates', [CertificateController::class, 'index'] );
Route::get('certificates/{id}', [CertificateController::class, 'show'] );

// Projects routes
Route::get('projects', [ProjectController::class, 'index'] );
Route::get('projects/{id}', [ProjectController::class, 'show'] );


// Mails routes
Route::post('mails', [MailController::class, 'store'] );



