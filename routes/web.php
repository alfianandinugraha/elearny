<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'get'])->middleware('guest');

Route::prefix('admin')->group(function() {
    Route::get('/login', [Admin\AuthController::class, 'get'])->middleware('guest:admin');

    Route::middleware('auth:admin')->group(function() {
        Route::get('/dashboard', [Admin\DashboardController::class, 'get'])->name('admin-dashboard');
    
        Route::prefix('lecturers')->group(function() {
            Route::get('/', [Admin\LecturerController::class, 'get']);
            Route::get('/add', [Admin\LecturerController::class, 'add']);
            Route::post('/add', [Admin\LecturerController::class, 'store']);
            Route::delete('/delete/{lecturerId}', [Admin\LecturerController::class, 'delete']);
            Route::get('/update/{lecturerId}', [Admin\LecturerController::class, 'edit']);
            Route::put('/update/{lecturerId}', [Admin\LecturerController::class, 'update']);
        });

        Route::prefix('student')->group(function() {
            Route::get('/', [Admin\StudentController::class, 'get']);
            Route::get('/add', [Admin\StudentController::class, 'add']);
            Route::post('/add', [Admin\StudentController::class, 'store']);
            Route::delete('/delete/{studentId}', [Admin\StudentController::class, 'delete']);
            Route::get('/update/{student}', [Admin\StudentController::class, 'edit']);
            Route::put('/update/{student}', [Admin\StudentController::class, 'update']);
        });
    });
});






Route::delete('/admin/logout', [Admin\AuthController::class, 'logout'])->middleware('auth:admin');

Route::post('/admin/login', [Admin\AuthController::class, 'attempt'])->middleware('guest:admin');
