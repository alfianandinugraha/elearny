<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function get() {
        $courses = Course::all();
        return view('pages.admin.courses.main', [
            'courses' => $courses
        ]);
    }

    public function add() {
        $semesters = [1, 2, 3, 4, 5, 6, 7, 8];
        return view('pages.admin.courses.add', [
            'semesters' => $semesters
        ]);
    }
}
