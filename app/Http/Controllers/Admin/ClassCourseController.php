<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassCourseController extends Controller
{
    public function get() {
        $classCourses = DB::table('class_courses')
            ->join('lecturers', 'class_courses.lecturer_id', '=', 'lecturers.lecturer_id')
            ->join('courses', 'class_courses.course_id', '=', 'courses.course_id')
            ->select([
                'courses.code', 'courses.semester', 'courses.name', 'class_courses.class', 'lecturers.fullname as lecturer_name', 'class_courses.class_course_id'
            ])
            ->get();

        return view('pages.admin.classes.main', [
            'classCourses' => $classCourses
        ]);
    }
}
