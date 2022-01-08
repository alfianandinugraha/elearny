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
        $metaData = (object) [
            'heading' => 'Tambah Kelas',
            'buttonText' => 'Tambah',
            'title' => 'Tambah Kelas',
            'action' => './add'
        ];

        return view('pages.admin.classes.form', compact('metaData'));
    }

    public function edit($classCourseId) {
        $classCourse = ClassCourse::query()
            ->getQuery()
            ->where('class_courses.class_course_id', $classCourseId)
            ->join('lecturers', 'lecturers.lecturer_id', '=', 'class_courses.lecturer_id')
            ->first([
                'lecturers.fullname AS lecturer_fullname', 'class_courses.*'
            ]);

        $metaData = (object) [
            'heading' => 'Update Kelas',
            'buttonText' => 'Update',
            'title' => 'Update Kelas',
            'action' => './update'
        ];

        return view('pages.admin.classes.form', compact('classCourse', 'metaData'));
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

        if ($isPicked) return back()->withErrors([
            'classAlreadyExist' => 'Kelas sudah diambil'
        ]);

        $validateData['class_course_id'] = uniqid();
        ClassCourse::query()->create($validateData)->save();

        return redirect('/admin/classes');
    }
}
