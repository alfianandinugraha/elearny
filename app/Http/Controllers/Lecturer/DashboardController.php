<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function get() {
        $lecturerId = Auth::guard('lecturer')->id();
        $classCourses = DB::table('class_courses')
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->join('courses', 'class_courses.course_id', '=', 'courses.course_id')
            ->select([
                'courses.semester', 'courses.name', 'class_courses.class_course_id', 'class_courses.class'
            ])
            ->get();

        return view('pages.lecturer.dashboard', [
            'classCourses' => $classCourses
        ]);
    }
}
