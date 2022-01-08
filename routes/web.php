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
            Route::delete('/{lecturerId}/delete/', [Admin\LecturerController::class, 'delete']);
            Route::get('/{lecturerId}/update/', [Admin\LecturerController::class, 'edit']);
            Route::put('/{lecturerId}/update/', [Admin\LecturerController::class, 'update']);
        });

        Route::prefix('student')->group(function() {
            Route::get('/', [Admin\StudentController::class, 'get']);
            Route::get('/add', [Admin\StudentController::class, 'add']);
            Route::post('/add', [Admin\StudentController::class, 'store']);
            Route::delete('/{studentId}/delete', [Admin\StudentController::class, 'delete']);
            Route::get('/{student}/update', [Admin\StudentController::class, 'edit']);
            Route::put('/{student}/update', [Admin\StudentController::class, 'update']);
        });

        Route::prefix('courses')->group(function() {
            Route::get('/', [Admin\CourseController::class, 'get']);
            Route::get('/add', [Admin\CourseController::class, 'add']);
            Route::post('/add', [Admin\CourseController::class, 'store']);
            Route::delete('/{courseId}/delete/', [Admin\CourseController::class, 'delete']);
            Route::get('/{courseId}/update', [Admin\CourseController::class, 'edit']);
            Route::put('/{courseId}/update', [Admin\CourseController::class, 'update']);
        });

        Route::prefix('classes')->group(function() {
            Route::get('/', [Admin\ClassCourseController::class, 'get']);
            Route::get('/add', [Admin\ClassCourseController::class, 'add']);
            Route::post('/add', [Admin\ClassCourseController::class, 'store']);
            Route::get('/{classCourseId}/update', [Admin\ClassCourseController::class, 'edit']);
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

        Route::prefix('materials')->group(function() {
            Route::get('/', [Lecturer\MaterialController::class, 'get']);
            Route::get('/add', [Lecturer\MaterialController::class, 'add']);
            Route::post('/add', [Lecturer\MaterialController::class, 'store']);
            Route::get('/{materialId}', [Lecturer\MaterialController::class, 'detail']);
            Route::get('/{materialId}/update', [Lecturer\MaterialController::class, 'edit']);
            Route::put('/{materialId}/update', [Lecturer\MaterialController::class, 'update']);
            Route::delete('/{materialId}/delete', [Lecturer\MaterialController::class, 'delete']);
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
        Route::delete('/logout', [Student\AuthController::class, 'logout']);

        Route::prefix('classes')->group(function() {
            Route::get('/', [Student\ClassCourseController::class, 'get']);
            Route::get('/search', [Student\ClassCourseController::class, 'search']);
            Route::get('/{classCourseId}', [Student\ClassCourseController::class, 'detail']);
            Route::delete('/{classCourseId}', [Student\ClassCourseController::class, 'delete']);
            Route::post('/{classCourseId}/pick', [Student\ClassCourseController::class, 'pick']);
        });

        Route::prefix('materials')->group(function() {
            Route::get('/', [Student\MaterialController::class, 'get']);
            Route::get('/{materialId}', [Student\MaterialController::class, 'detail']);
        });
    });
});
