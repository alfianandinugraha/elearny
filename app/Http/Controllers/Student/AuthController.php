<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function get() {
        return view('pages.student.login');
    }

    public function attempt(Request $request) {
        $validateData = $request->validate([
            'student_number' => ['required'],
            'password' => ['required']
        ]);

        AuthService::logoutAll();
        $isValid = Auth::guard('student')->attempt($validateData);

        if (!$isValid) {
            return back();
        }

        return redirect('/student/dashboard');
    }

    public function logout() {
        AuthService::logoutAll();
        return redirect('/student/login');
    }
}
