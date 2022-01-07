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
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public static function formValidator($requestAll) {
        return Validator::make($requestAll, [
            'title' => ['required'],
            'course_id' => ['required'],
            'class' => ['required'],
            'content' => ['required'],
            'file' => ['file']
        ]);
    }

    public static function uniqueFilename($filename) {
        $result = explode('.', $filename);
        $ext = last($result);
        array_pop($result);
        $result = implode("", $result) . "_" . uniqid() . "." . $ext;

        return $result;
    }

    public static function form(Request $request) {
        $validateData = MaterialController::formValidator($request->all())->validate();
        $validateData['material_id'] = uniqid();
        $validateData['filename'] = '';

        $lecturerId = Auth::guard('lecturer')->id();
        $file = $request->file('file');

        if ($file) {
            unset($validateData['file']);
            $validateData['filename'] = MaterialController::uniqueFilename(
                $file->getClientOriginalName()
            );
        }

        $classCourse = ClassCourse::checkClass([
            'course_id' => $validateData['course_id'],
            'class' => $validateData['class'],
            'lecturer_id' => $lecturerId
        ]);

        if (!$classCourse) return back()->withErrors([
            'class_course_not_found' => 'Kelas tidak ditemukan'
        ]);

        $validateData['class_course_id'] = $classCourse->class_course_id;

        return $validateData;
    }

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
        $validateData = MaterialController::form($request);
        $file = $request->file('file');

        $isSaved = Material::query()->create($validateData)->save();

        if($isSaved && !empty($validateData['filename'])) {
            Storage::disk('materials')->put($validateData['filename'], $file->get());
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

    public function update($materialId, Request $request) {
        $validateData = MaterialController::form($request);
        $file = $request->file('file');

        $payload = [
            'title' => $validateData['title'],
            'content' => $validateData['content'],
            'class_course_id' => $validateData['class_course_id'],
            'filename' => $validateData['filename']
        ];

        if (empty($validateData['filename'])) {
            unset($payload['filename']);
        }

        $oldMaterial = Material::query()
            ->find($materialId, ['filename']);
            $isSaved = Material::query()->where('material_id', $materialId)->update($payload);
            
        if($isSaved && !empty($payload['filename'])) {
            Storage::disk('materials')->delete($oldMaterial['filename']);
            Storage::disk('materials')->put($payload['filename'], $file->get());
        }

        return redirect("/lecturer/materials/$materialId");
    }

    public function delete($materialId) {
        Material::destroy($materialId);
        return redirect('/lecturer/materials');
    }
}
