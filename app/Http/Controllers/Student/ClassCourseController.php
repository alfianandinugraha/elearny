<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassCourseController extends Controller
{
    public function get() {
        $studentId = Auth::guard('student')->id();

        $classCourses = DB::table('student_courses')
            ->where('student_courses.student_id', $studentId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'student_courses.class_course_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->join('lecturers', 'lecturers.lecturer_id', '=', 'class_courses.lecturer_id')
            ->select([
                'courses.code', 'courses.name', 'courses.description', 'courses.semester', 'class_courses.class', 'class_courses.class_course_id', 'lecturers.fullname as lecturer_name'
            ])
            ->get();

        return view('pages.student.classes.main', [
            'classCourses' => $classCourses
        ]);
    }

    public function search() {
        $classCourses = DB::table('class_courses')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->join('lecturers', 'lecturers.lecturer_id', '=', 'class_courses.lecturer_id')
            ->select([
                'courses.code', 'courses.name', 'courses.description', 'courses.semester', 'class_courses.class', 'class_courses.class_course_id', 'lecturers.fullname as lecturer_name'
            ])
            ->get();

        return view('pages.student.classes.search', [
            'classCourses' => $classCourses
        ]);
    }
}
