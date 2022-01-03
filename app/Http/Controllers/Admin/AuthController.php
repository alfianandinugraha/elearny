<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function get() {
        return view('pages.admin.login');
    }

    public function attempt(Request $request) {
        $isValid = Auth::guard('admin')->attempt($request->only('username', 'password'));
        if (!$isValid) {
            return back();
        }

        return redirect(route('admin-dashboard'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
