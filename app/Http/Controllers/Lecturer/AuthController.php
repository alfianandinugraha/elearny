<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function get() {
        return view('pages.lecturer.login');
    }

    public function attempt(Request $request) {
        $isValid = Auth::guard('lecturer')->attempt($request->only('lecturer_number', 'password'));

        if (!$isValid) {
            return back();
        }

        return redirect('/lecturer/dashboard');
    }

    public function logout() {
        Auth::guard('lecturer')->logout();
        return redirect('/lecturer/login');
    }
}
