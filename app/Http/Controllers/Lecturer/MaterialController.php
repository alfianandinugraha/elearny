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

    public function add() {
        $lecturerId = Auth::guard('lecturer')->id();

        $hasClass = ClassCourse::query()
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->get()
            ->count();
        
        if (!$hasClass) return back();

        $classes = ['A', 'B', 'C', 'D'];
        $courses = DB::table('class_courses')
            ->where('class_courses.lecturer_id', '=', $lecturerId)
            ->join('courses', 'courses.course_id', '=', 'class_courses.course_id')
            ->select(['courses.course_id', 'courses.name', 'courses.code'])
            ->get();

        return view('pages.lecturer.materials.add', [
            'classes' => $classes,
            'courses' => $courses
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
}
