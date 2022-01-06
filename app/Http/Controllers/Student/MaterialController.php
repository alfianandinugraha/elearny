<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
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
