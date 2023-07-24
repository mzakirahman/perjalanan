<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LauncerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerjalananController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LauncerController::class, 'index'])->name('/');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management')->middleware('auth');
Route::get('/user-management/detail', [UserManagementController::class, 'detail'])->name('user-management.detail')->middleware('auth');
Route::post('/user-management/add', [UserManagementController::class, 'add'])->name('user-management.add')->middleware('auth');
Route::post('/user-management/edit', [UserManagementController::class, 'edit'])->name('user-management.edit')->middleware('auth');
Route::post('/user-management/delete', [UserManagementController::class, 'delete'])->name('user-management.delete')->middleware('auth');

Route::get('/input-perjalanan', [PerjalananController::class, 'input'])->name('perjalanan.input')->middleware('auth');
Route::get('/terima-perjalanan', [PerjalananController::class, 'terima'])->name('perjalanan.terima')->middleware('auth');

Route::post('/input-perjalanan/add', [PerjalananController::class, 'add_input'])->name('perjalanan.add_input')->middleware('auth');
Route::post('/input-perjalanan/edit', [PerjalananController::class, 'edit_input'])->name('perjalanan.edit_input')->middleware('auth');
Route::get('/perjalanan/detail', [PerjalananController::class, 'detail'])->name('perjalanan.detail')->middleware('auth');

Route::post('/terima-perjalanan/add', [PerjalananController::class, 'add_terima'])->name('perjalanan.add_terima')->middleware('auth');

Route::get('/riwayat', [PerjalananController::class, 'riwayat'])->name('riwayat')->middleware('auth');
Route::get('/riwayat/export', [PerjalananController::class, 'export'])->name('riwayat.export')->middleware('auth');
