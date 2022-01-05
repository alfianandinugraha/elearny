<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
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

    public function edit($courseId) {
        $lecturerId = Auth::guard('lecturer')->id();

        $classCourse = DB::table('lecturers')
            ->where('lecturers.lecturer_id', $lecturerId)
            ->where('class_courses.class_course_id', $courseId)
            ->join('class_courses', 'lecturers.lecturer_id', '=', 'class_courses.lecturer_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->select([
                'class_courses.*', 'courses.name', 'courses.code', 'courses.semester'
            ])
            ->first();

            return view('pages.lecturer.classes.edit', [
                'classCourse' => $classCourse
            ]);
    }

    public function update($classCourseId, Request $request) {
        $validateData = $request->validate([
            'token' => ['required']
        ]);

        $lecturerId = Auth::guard('lecturer')->id();
        ClassCourse::query()
            ->where('lecturer_id', $lecturerId)
            ->where('class_course_id', $classCourseId)
            ->update([
                'token' => $validateData['token']
            ]);
        return back();
    }
}
