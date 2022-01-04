<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CourseController extends Controller
{
    public function get() {
        $courses = Course::all();
        return view('pages.admin.courses.main', [
            'courses' => $courses
        ]);
    }

    public function add() {
        $semesters = [1, 2, 3, 4, 5, 6, 7, 8];
        return view('pages.admin.courses.add', [
            'semesters' => $semesters
        ]);
    }

    public function store(Request $request) {
        $payload = $request->validate([
            'course_id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'semester' => ['required'],
        ]);
        
        $isIdFound = Course::all()->where('course_id', $payload['course_id'])->first();
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
