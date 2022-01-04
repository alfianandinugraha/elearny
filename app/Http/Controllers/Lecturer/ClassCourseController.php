<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassCourseController extends Controller
{
    public function get() {
        $lecturerId = Auth::guard('lecturer')->id();

        $courses = DB::table('lecturers')
            ->where('lecturers.lecturer_id', $lecturerId)
            ->join('class_courses', 'lecturers.lecturer_id', '=', 'class_courses.lecturer_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->select([
                'class_courses.*', 'courses.name', 'courses.code', 'courses.semester'
            ])
            ->get();

        return view('pages.lecturer.classes.main', [
            'courses' => $courses
        ]);
    }
}
