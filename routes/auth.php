<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {
//     Route::get('register', [RegisteredUserController::class, 'create'])
//         ->name('register');

//     Route::post('register', [RegisteredUserController::class, 'store']);

//     Route::get('login', [AuthenticatedSessionController::class, 'create'])
//         ->name('login');

//     Route::post('login', [AuthenticatedSessionController::class, 'store']);

//     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//         ->name('password.request');

//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//         ->name('password.email');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//         ->name('password.reset');

//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//         ->name('password.store');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('verify-email', EmailVerificationPromptController::class)
//         ->name('verification.notice');

//     Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//         ->middleware(['signed', 'throttle:6,1'])
//         ->name('verification.verify');

//     Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//         ->middleware('throttle:6,1')
//         ->name('verification.send');

//     Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
//         ->name('password.confirm');

//     Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

//     Route::put('password', [PasswordController::class, 'update'])->name('password.update');

//     Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
//         ->name('auth.logout');
// });


Route::prefix('auth')->group(function () {
    // Authentication Routes...
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('auth.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('auth.logout');

    // Registration Routes...
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('auth.register');

    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    // Password Reset Routes...
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('auth.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('auth.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('auth.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('auth.password.update');
});