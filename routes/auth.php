<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "auth" middleware group. Make something great!
|
*/

// Login Routes...
Route::get('acessar', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('acessar', [LoginController::class, 'login']);

// Logout Routes...
Route::post('sair', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('cadastro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('cadastro', [RegisterController::class, 'register']);
Route::get('cadastro/{referral_token}', [RegisterController::class, 'showRegistrationForm']);

// Password Reset Routes...
Route::get('senha/resetar', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('senha/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('senha/resetar/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('senha/resetar', [ResetPasswordController::class, 'reset'])->name('password.update');

// Password Confirmation Routes...
Route::get('senha/confirmar', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('senha/confirmar', [ConfirmPasswordController::class, 'confirm']);

// Email Verification Routes...
Route::get('email/verificar', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verificar/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/reenviar', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('esqueci/senha', [ForgotPasswordController::class, 'showEmailForm'])->name('showEmailForm');
Route::post('esqueci/enviar', [ForgotPasswordController::class, 'sendResetPassMail'])->name('resetpassword.send');
Route::get('resetar/{code}', [ForgotPasswordController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('resetar/senha', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');