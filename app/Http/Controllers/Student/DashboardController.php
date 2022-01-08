<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function get() {
        $studentId = Auth::guard('student')->id();

        $studentClassQuery = DB::table('student_courses')
            ->where('student_courses.student_id', $studentId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'student_courses.class_course_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id');
        $classes = $studentClassQuery->clone()
            ->get(['courses.semester', 'courses.name AS course_name', 'class_courses.class', 'class_courses.class_course_id'])
            ->toArray();
        $totalClass = $studentClassQuery->clone()->count();

        $materialsQuery = DB::table('student_courses')
            ->where('student_courses.student_id', $studentId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'student_courses.class_course_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->join('materials', 'materials.class_course_id', '=', 'class_courses.class_course_id');

        $materials = $materialsQuery->clone()
            ->limit(5)
            ->get(['materials.*', 'courses.code'])
            ->toArray();
        $totalMaterial = $materialsQuery->clone()->count();

        return view('pages.student.dashboard', [
            'totalClass' => $totalClass,
            'classes' => $classes,
            'totalClass' => $totalClass,
            'materials' => $materials,
            'totalMaterial' => $totalMaterial
        ]);
    }
}
