<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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

Route::get('/admin/dashboard', [Admin\DashboardController::class, 'get'])
    ->middleware('auth:admin')
    ->name('admin-dashboard');

Route::get('/admin/login', [Admin\AuthController::class, 'get'])->middleware('guest:admin');

Route::get('/admin/logout', [Admin\AuthController::class, 'logout'])->middleware('auth:admin');

Route::post('/admin/login', [Admin\AuthController::class, 'attempt'])->middleware('guest:admin');
