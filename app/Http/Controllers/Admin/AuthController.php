<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function get() {
        return view('pages.admin.login');
    }

    public function attempt(Request $request) {
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        AuthService::logoutAll();
        $isValid = Auth::guard('admin')->attempt($request->only('username', 'password'));
        if (!$isValid) {
            return back()->withInput()->withErrors([
                'failed' => trans('auth.failed')
            ]);
        }

        return redirect(route('admin-dashboard'));
    }

    public function logout() {
        AuthService::logoutAll();
        return redirect('/admin/login');
    }
}
