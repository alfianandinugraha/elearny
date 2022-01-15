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
        $pageType = 'add';
        
        return view('pages.admin.courses.form', compact('pageType'));
    }
    
    public function edit($courseId) {
        $course = Course::all()->where('course_id', $courseId)->first();
        $pageType = 'update';

        return view('pages.admin.courses.form', compact('course', 'pageType'));
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

    public function update($courseId, Request $request) {
        $payload = $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'semester' => ['required'],
        ]);

        Course::query()->where('course_id', $courseId)->update($payload);

        return back();
    }

    public function delete($courseId, Request $request) {
        Course::destroy($courseId);
        return back();
    }
}
