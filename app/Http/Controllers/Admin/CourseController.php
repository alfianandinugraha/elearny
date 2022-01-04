<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CourseController extends Controller
{
    protected static $semesters = [1, 2, 3, 4, 5, 6, 7, 8];

    public function get() {
        $courses = Course::all();
        return view('pages.admin.courses.main', [
            'courses' => $courses
        ]);
    }

    public function add() {
        return view('pages.admin.courses.add', [
            'semesters' => CourseController::$semesters
        ]);
    }

    public function edit($courseId) {
        $course = Course::all()->where('course_id', $courseId)->first();
        return view('pages.admin.courses.edit', [
            'course' => $course,
            'semesters' => CourseController::$semesters
        ]);
    }

    public function store(Request $request) {
        $payload = $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'semester' => ['required'],
        ]);
        $payload['course_id'] = Uuid::uuid4();
        
        $isIdFound = Course::all()->where('code', $payload['code'])->first();
        if ($isIdFound) {
            return back();
        }

        Course::query()->create($payload)->save();

        return redirect('/admin/courses');
    }

    public function delete($courseId, Request $request) {
        Course::destroy($courseId);
        return back();
    }
}
