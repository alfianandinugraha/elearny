<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function get() {
        $studentId = Auth::guard('student')->id();
        $materials = Material::query()
            ->getQuery()
            ->where('student_courses.student_id', $studentId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'materials.class_course_id')
            ->join('student_courses', 'student_courses.class_course_id', '=', 'class_courses.class_course_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->join('lecturers', 'lecturers.lecturer_id', '=', 'class_courses.lecturer_id')
            ->get([
                'courses.name AS course_name', 'materials.*', 'class_courses.class', 'lecturers.fullname AS lecturer_name'
            ]);
        
        // dd($materials);
        return view('pages.student.materials.main', [
            'materials' => $materials
        ]);
    }

    public function detail($materialId) {
        $material = DB::table('materials')
            ->where('materials.material_id', $materialId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'materials.class_course_id')
            ->join('courses', 'class_courses.course_id', '=', 'courses.course_id')
            ->get([
                "materials.title", "materials.content", "materials.filename", "materials.material_id", "courses.name AS course_name", "class_courses.class_course_id" 
            ])
            ->first();

        return view('pages.student.materials.detail', [
            'material' => $material
        ]);
    }
}
