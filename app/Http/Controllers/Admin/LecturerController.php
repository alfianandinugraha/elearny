<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class LecturerController extends Controller
{
    public static $rules = [
        'lecturer_number' => ['required'],
        'fullname' => ['required'],
        'email' => ['required'],
        'gender' => ['required'],
        'password' => ['required'],
    ];

    public static $attributes = [
        'lecturer_number' => 'NIP',
        'fullname' => 'nama lengkap'
    ];

    public function get() {
        $lecturers = Lecturer::all();
        return view('pages.admin.lecturer.main', [
            'lecturers' => $lecturers,
        ]);
    }

    public function add() {
        $pageType = 'add';

        return view('pages.admin.lecturer.form', compact('pageType'));
    }

    public function edit($lecturerId) {
        $lecturer = Lecturer::all()->where('lecturer_id', $lecturerId)->first();
        $pageType = "update";

        return view('pages.admin.lecturer.form', compact('lecturer', 'pageType'));
    }

    public function update($lecturerId, Request $request) {
        unset(LecturerController::$rules['password']);
        $validator = Validator::make($request->all(), LecturerController::$rules, [], LecturerController::$attributes);
        $payload = $validator->validate();

        Lecturer::query()->where('lecturer_id', $lecturerId)->update($payload);

        return back();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), LecturerController::$rules, [], LecturerController::$attributes);
        $payload = $validator->validate();
        $errors = [];

        $isLecturerNumberExist = Lecturer::query()->where('lecturer_number', $payload['lecturer_number'])->first();
        if ($isLecturerNumberExist) {
            $errors['lecturer_number_exist'] = "NIP telah terdaftar.";
        }

        $isEmailExist = Lecturer::query()->where('email', $payload['email'])->first();
        if ($isEmailExist) {
            $errors['email_exist'] = "Email telah terdaftar.";
        }

        if (count($errors)) {
            return back()->withInput()->withErrors($errors);
        }

        $payload['lecturer_id'] = Uuid::uuid4();
        
        $lecturer = new Lecturer();
        $lecturer->lecturer_id = Uuid::uuid4();
        $lecturer->lecturer_number = $payload['lecturer_number'];
        $lecturer->fullname = $payload['fullname'];
        $lecturer->email = $payload['email'];
        $lecturer->password = Hash::make($payload['password']);
        $lecturer->gender = $payload['gender'];
        $lecturer->save();

        return redirect('/admin/lecturers');
    }

    public function delete($lecturerId, Request $request) {
        Lecturer::destroy($lecturerId);
        return back();
    }
}
