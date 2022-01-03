<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function get() {
        $student = Student::all();
        return view('pages.admin.student.main', [
            'student' => $student
        ]);
    }

    public function add() {
        return view('pages.admin.student.add');
    }

    public function delete($studentId, Request $request) {
        Student::destroy($studentId);
        return back();
    }
}
