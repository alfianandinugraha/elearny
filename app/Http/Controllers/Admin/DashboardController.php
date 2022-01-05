<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\Lecturer;
use App\Models\Student;

class DashboardController extends Controller
{
    public function get() {
        $lecturers = Lecturer::all();
        $student = Student::all();
        $totalClassCourse = ClassCourse::all()->count();

        return view('pages.admin.dashboard', [
            'lecturers' => $lecturers,
            'student' => $student,
            'totalClassCourse' => $totalClassCourse
        ]);
    }
}
