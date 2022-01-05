<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Lecturer;
use App\Http\Controllers\Student;
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
    Route::middleware('guest:admin')->group(function() {
        Route::get('/login', [Admin\AuthController::class, 'get']);
        Route::post('/login', [Admin\AuthController::class, 'attempt']);
    });

    Route::middleware('auth:admin')->group(function() {
        Route::get('/dashboard', [Admin\DashboardController::class, 'get'])->name('admin-dashboard');
        Route::delete('/logout', [Admin\AuthController::class, 'logout']);
    
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

        Route::prefix('courses')->group(function() {
            Route::get('/', [Admin\CourseController::class, 'get']);
            Route::get('/add', [Admin\CourseController::class, 'add']);
            Route::post('/add', [Admin\CourseController::class, 'store']);
            Route::delete('/delete/{courseId}', [Admin\CourseController::class, 'delete']);
            Route::get('/update/{courseId}', [Admin\CourseController::class, 'edit']);
            Route::put('/update/{courseId}', [Admin\CourseController::class, 'update']);
        });
    });
});

Route::prefix('lecturer')->group(function() {
    Route::middleware('guest:lecturer')->group(function() {
        Route::get('/login', [Lecturer\AuthController::class, 'get']);
        Route::post('/login', [Lecturer\AuthController::class, 'attempt']);
    });

    Route::middleware('auth:lecturer')->group(function() {
        Route::get('/dashboard', [Lecturer\DashboardController::class, 'get']);
        Route::delete('/logout', [Lecturer\AuthController::class, 'logout']);
        
        Route::prefix('classes')->group(function() {
            Route::get('/', [Lecturer\ClassCourseController::class, 'get']);
            Route::get('/{classCourseId}/update', [Lecturer\ClassCourseController::class, 'edit']);
            Route::put('/{classCourseId}/update', [Lecturer\ClassCourseController::class, 'update']);
        });
    });
});

Route::prefix('student')->group(function() {
    Route::middleware('guest:student')->group(function() {
        Route::get('/login', [Student\AuthController::class, 'get']);
        Route::post('/login', [Student\AuthController::class, 'attempt']);
    });

    Route::middleware('auth:student')->group(function() {
        Route::get('/dashboard', [Student\DashboardController::class, 'get']);

        Route::prefix('classes')->group(function() {
            Route::get('/', [Student\ClassCourseController::class, 'get']);
            Route::get('/search', [Student\ClassCourseController::class, 'search']);
            Route::post('/{classCourseId}/pick', [Student\ClassCourseController::class, 'pick']);
        });
    });
});
