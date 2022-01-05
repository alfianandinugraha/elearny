<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {
  public static $roles = ['admin', 'lecturer', 'student'];

  public static function logoutAll() {
    foreach (AuthService::$roles as $role) {
      if (Auth::guard($role)->check()) {
        return Auth::guard($role)->logout();
      }
    };
  }

  public function currentRole() {
    foreach (AuthService::$roles as $role) {
      if (Auth::guard($role)->check()) {
        return $role;
      }
    };

    return '';
  }
}