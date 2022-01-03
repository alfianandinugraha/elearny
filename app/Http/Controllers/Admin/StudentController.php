<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

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

    public function store(Request $request) {
        $payload = $request->validate([
            'student_number' => ['required'],
            'fullname' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
            'password' => ['required'],
        ]);
        $payload['student_id'] = Uuid::uuid4();

        Student::query()->create($payload)->save();

        return redirect('/admin/student');
    }
}
