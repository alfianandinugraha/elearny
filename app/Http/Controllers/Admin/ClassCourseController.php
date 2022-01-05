<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\Lecturer;
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

    public function add() {
        $lecturers = Lecturer::query()
            ->get(['fullname', 'lecturer_id', 'lecturer_number']);
        $courses = Course::query()
            ->get(['code', 'name', 'course_id']);
        $classes = ['A', 'B', 'C', 'D'];

        return view('pages.admin.classes.add', [
            'lecturers' => $lecturers,
            'courses' => $courses,
            'classes' => $classes
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'lecturer_id' => ['required'],
            'course_id' => ['required'],
            'class' => ['required'],
        ]);

        $isPicked = ClassCourse::query()
            ->where('lecturer_id', '=', $validateData['lecturer_id'])
            ->where('course_id', '=', $validateData['course_id'])
            ->where('class', '=', $validateData['class'])
            ->get()
            ->first();

        if ($isPicked) return back();

        $validateData['class_course_id'] = uniqid();
        ClassCourse::query()->create($validateData)->save();

        return redirect('/admin/classes');
    }
}
