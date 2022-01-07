<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function get() {
        $lecturerId = Auth::guard('lecturer')->id();

        $hasClass = ClassCourse::query()
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->get()
            ->count();

        $materials = DB::table('materials')
            ->join('class_courses', 'materials.class_course_id', '=', 'class_courses.class_course_id')
            ->join('courses', 'class_courses.course_id', '=', 'courses.course_id')
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->select([
                'materials.material_id', 'materials.title', 'class_courses.class', 'courses.semester', 'courses.name as course_name'
            ])
            ->get();

        return view('pages.lecturer.materials.main', [
            'materials' => $materials,
            'hasClass' => $hasClass
        ]);
    }

    public function detail($materialId) {
        $material = Material::detail($materialId);
        return view('pages.lecturer.materials.detail', [
            'material' => $material
        ]);
    }

    public function add() {
        $lecturerId = Auth::guard('lecturer')->id();

        $hasClass = ClassCourse::query()
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->get()
            ->count();
        
        if (!$hasClass) return back();

        $courses = DB::table('class_courses')
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->select(['courses.course_id', 'courses.name', 'courses.code'])
            ->get();

        $material = (object) [
            'title' => '',
            'content' => '',
            'code' => '',
            'class' => ''
        ];

        return view('pages.lecturer.materials.form', [
            'courses' => $courses,
            'action' => 'ADD',
            'material' => $material
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'title' => ['required'],
            'course_id' => ['required'],
            'class' => ['required'],
            'content' => ['required'],
            'file' => ['file']
        ]);

        $validateData['material_id'] = uniqid();

        $file = $request->file('file');
        $filename = "";

        if ($file) {
            unset($validateData['file']);

            $filename = explode('.', $file->getClientOriginalName());
            $ext = last($filename);
            array_pop($filename);
            $filename = implode("", $filename) . "_" . uniqid() . "." . $ext;

            $validateData['filename'] = $filename;
        }

        $classCourse = ClassCourse::query()
            ->where('course_id', $validateData['course_id'])
            ->where('class', $validateData['class'])
            ->get(['class_course_id'])
            ->first();

        if (!$classCourse) return back()->withErrors([
            'class_course_not_found' => 'Kelas tidak ditemukan'
        ]);

        $validateData['class_course_id'] = $classCourse->class_course_id;
        $isSaved = Material::query()->create($validateData)->save();

        if($isSaved && $filename) {
            Storage::disk('materials')->put($filename, $file->get());
        }
        return redirect('/lecturer/materials');
    }

    public function edit($materialId) {
        $lecturerId = Auth::guard('lecturer')->id();

        $material = DB::table('materials')
            ->where('materials.material_id', '=', $materialId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'materials.class_course_id')
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->get([
                'class_courses.class', 'materials.*', 'courses.code'
            ])
            ->first();

        $courses = DB::table('class_courses')
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->select(['courses.course_id', 'courses.name', 'courses.code'])
            ->get();

        return view('pages.lecturer.materials.form', [
            'material' => $material,
            'courses' => $courses,
            'action' => 'UPDATE'
        ]);
    }

    public function delete($materialId) {
        Material::destroy($materialId);
        return redirect('/lecturer/materials');
    }
}
