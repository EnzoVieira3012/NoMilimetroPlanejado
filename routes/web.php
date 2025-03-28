<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; // Importação do Auth para logout
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TestAuthenticatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;

// Rotas normais
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/clients', [LandingPageController::class, 'storeClient'])->name('clients.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/password', function () {
    return view('pages.password');
})->name('password');
Route::post('/password/email', [PasswordController::class, 'sendResetLink'])->name('password.email');
Route::post('/password/reset', [PasswordController::class, 'resetPassword'])->name('password.reset');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user-profile');
    Route::post('/user-profile/update', [UserProfileController::class, 'update'])->name('user-profile.update');
    Route::post('/user-profile/upload-image', [UserProfileController::class, 'uploadProfileImage'])->name('user-profile.upload-image');
    Route::post('/user-profile/update-password', [UserProfileController::class, 'updatePassword'])->name('user-profile.update-password');
    Route::post('/user-profile/delete-account', [UserProfileController::class, 'deleteAccount'])->name('user-profile.delete-account');

    Route::get('/clientes', [ClientController::class, 'index'])->name('clientes');
    Route::get('/clientes/pdf', [ClientController::class, 'generatePDF'])->name('clientes.pdf');

    Route::get('/clientes/novo', [ClientController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/novo', [ClientController::class, 'store'])->name('clientes.store');
    
    Route::get('/clientes/perfil/{id}', [ClientController::class, 'profile'])->name('clientes.profile');
    Route::post('/clientes/update/{id}', [ClientController::class, 'update'])->name('clientes.update');
    Route::post('/clientes/{id}/comentarios', [ClientController::class, 'storeUserComment'])->name('clientes.comentarios.store');
    Route::get('/clientes/{id}/comentarios', [ClientController::class, 'getUserComments'])->name('clientes.comentarios.get');
    Route::delete('/clientes/delete/{id}', [ClientController::class, 'destroy'])->name('clientes.delete');
    
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

// Rotas de teste
Route::get('/test-authenticator', [TestAuthenticatorController::class, 'index'])->name('test.authenticator');
Route::post('/test-authenticator', [TestAuthenticatorController::class, 'validateCode'])->name('test.authenticator.validate');

Route::get('/test-email', function () {
    return view('tests.test-email');
});
Route::post('/test-email', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $token = Str::random(60);
    Mail::to($request->email)->send(new ResetPasswordMail($token));

    return back()->with('success', 'E-mail enviado com sucesso para ' . $request->email);
});
