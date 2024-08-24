<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
    Route::get('/login', [AuthenticationController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('/register', [AuthenticationController::class, 'registerView'])->name('registerView');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    // Account Settings
    Route::get('/account-settings', [AuthenticationController::class, 'accountSettingsView'])->name('account-settings');
    Route::post('/account-settings/update-name', [AuthenticationController::class, 'updateName'])->name('update-name');
    Route::post('/account-settings/update-email', [AuthenticationController::class, 'updateEmail'])->name('update-email');
    Route::post('/account-settings/update-password', [AuthenticationController::class, 'updatePassword'])->name('update-password');
    Route::post('/account-settings/update-phone', [AuthenticationController::class, 'updatePhone'])->name('update-phone');
    Route::post('/account-settings/update-provinsi', [AuthenticationController::class, 'updateProvinsi'])->name('update-provinsi');
    Route::post('/account-settings/update-kota', [AuthenticationController::class, 'updateKota'])->name('update-kota');
    Route::post('/account-settings/update-profile-picture', [AuthenticationController::class, 'updateProfilePicture'])->name('update-profile-picture');

    Route::get('/home', [DashboardController::class, 'homeView'])->name('dashboard-home');
    Route::get('/list-menu', [DashboardController::class, 'listMenuView'])->name('dashboard-listMenu');
    Route::post('/list-menu/add-menu', [DashboardController::class, 'addMenu'])->name('dashboard-addMenu');
    Route::post('/list-menu/upload-foto', [DashboardController::class, 'uploadFoto'])->name('dashboard-uploadFoto');
    Route::post('/list-menu/delete-foto', [DashboardController::class, 'deleteFoto'])->name('dashboard-deleteFoto');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});
