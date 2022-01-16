<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class CourseController extends Controller
{
    protected static $semesters = [1, 2, 3, 4, 5, 6, 7, 8];

    protected static $rules = [
        'code' => ['required'],
        'name' => ['required'],
        'description' => ['required'],
        'semester' => ['required'],
    ];

    protected static $attributes = [
        'code' => 'kode',
        'name' => 'nama mata kuliah',
        'description' => 'deskripsi',
    ];

    public function get() {
        $courses = Course::all();
        return view('pages.admin.courses.main', [
            'courses' => $courses
        ]);
    }

    public function add() {
        $pageType = 'add';
        
        return view('pages.admin.courses.form', compact('pageType'));
    }
    
    public function edit($courseId) {
        $course = Course::all()->where('course_id', $courseId)->first();
        $pageType = 'update';

        return view('pages.admin.courses.form', compact('course', 'pageType'));
    }

    public function store(Request $request) {
        $validation = Validator::make(
            $request->all(), 
            CourseController::$rules, 
            [],
            CourseController::$attributes
        );
        $payload = $validation->validate();
        $payload['course_id'] = Uuid::uuid4();
        
        $isIdFound = Course::all()->where('code', $payload['code'])->first();
        $errors = [];

        if ($isIdFound) {
            $errors['code_exist'] = MessageService::database()->exist('kode');
        }

        if (count($errors)) {
            return back()->withInput()->withErrors($errors);
        }

        Course::query()->create($payload)->save();

        return redirect('/admin/courses');
    }

    public function update($courseId, Request $request) {
        $validation = Validator::make(
            $request->all(), 
            CourseController::$rules, 
            [],
            CourseController::$attributes
        );
        $payload = $validation->validate();

        $course = Course::all()->where('code', $payload['code'])->first();
        $errors = [];

        if ($course && $course->course_id != $courseId) {
            $errors['code_exist'] = MessageService::database()->exist('kode');
        }

        if (count($errors)) {
            return back()->withInput()->withErrors($errors);
        }

        Course::query()->where('course_id', $courseId)->update($payload);

        return back();
    }

    public function delete($courseId, Request $request) {
        Course::destroy($courseId);
        return back();
    }
}
