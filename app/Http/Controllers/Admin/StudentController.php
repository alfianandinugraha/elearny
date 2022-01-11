<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class StudentController extends Controller
{
    public static $rules = [
        'student_number' => ['required'],
        'fullname' => ['required'],
        'email' => ['required'],
        'gender' => ['required'],
        'password' => ['required'],
    ];

    public static $attributes = [
        'student_number' => 'NIM',
        'fullname' => 'nama lengkap',
    ];

    public function get() {
        $student = Student::all();
        return view('pages.admin.student.main', [
            'student' => $student
        ]);
    }

    public function add() {
        $pageType = 'add';

        return view('pages.admin.student.form', compact('pageType'));
    }

    public function edit($studentId, Request $request) {
        $student = Student::all()->where('student_id', $studentId)->first();
        $student->student_number = old('student_number') ?? $student->student_number;
        $student->email = old('email') ?? $student->email;
        $student->fullname = old('fullname') ?? $student->fullname;
        $student->gender = old('gender') ?? $student->gender;
        $pageType = 'update';

        return view('pages.admin.student.form', compact('student', 'pageType'));
    }

    public function update($studentId, Request $request) {
        unset(StudentController::$rules['password']);
        $validator = Validator::make($request->all(), StudentController::$rules, [], StudentController::$attributes);

        $payload = $validator->validate();
        $errors = [];

        $student = Student::query()->where('student_number', $payload['student_number'])->first(['student_id']);
        if ($student && $student['student_id'] != $studentId) {
            $errors['student_number_exist'] = "NIM sudah terdaftar";
        }

        $student = Student::query()->where('email', $payload['email'])->first(['email', 'student_id']);
        if ($student && $student['student_id'] != $studentId) {
            $errors['email_exist'] = "Email sudah terdaftar";
        };

        if (count($errors)) {
            return back()->withInput()->withErrors($errors);
        }

        Student::query()->where('student_id', $studentId)->update($payload);

        return back();
    }

    public function delete($studentId, Request $request) {
        Student::destroy($studentId);
        return back();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), StudentController::$rules, [], StudentController::$attributes);

        $payload = $validator->validate();
        $errors = [];
        
        $isStudentNumberExist = Student::query()->where('student_number', $payload['student_number'])->first();
        if ($isStudentNumberExist) {
            $errors['student_number_exist'] = "NIM sudah terdaftar";
        }
        
        $isEmailExist = Student::query()->where('email', $payload['email'])->first();
        if ($isEmailExist) {
            $errors['email_exist'] = "Email sudah terdaftar";
        };
        
        if (count($errors)) {
            return back()->withInput()->withErrors($errors);
        }
        
        $payload['student_id'] = Uuid::uuid4();
        Student::query()->create($payload)->save();

        return redirect('/admin/student');
    }
}
