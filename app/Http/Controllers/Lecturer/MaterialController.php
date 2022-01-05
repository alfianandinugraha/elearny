<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function get() {
        $lecturerId = Auth::guard('lecturer')->id();

        $materials = DB::table('materials')
            ->join('class_courses', 'materials.class_course_id', '=', 'class_courses.class_course_id')
            ->join('courses', 'class_courses.course_id', '=', 'courses.course_id')
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->select([
                'materials.material_id', 'materials.title', 'class_courses.class', 'courses.semester', 'courses.name as course_name'
            ])
            ->get();

        return view('pages.lecturer.materials.main', [
            'materials' => $materials
        ]);
    }

    public function add() {
        $classes = ['A', 'B', 'C', 'D'];
        $courses = Course::query()
            ->get([
                'courses.course_id', 'courses.name', 'courses.code'
            ]);

        return view('pages.lecturer.materials.add', [
            'classes' => $classes,
            'courses' => $courses
        ]);
    }
}
