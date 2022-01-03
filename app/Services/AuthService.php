<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {
  public function currentRole() {
    $roles = ['admin', 'lecturer', 'student'];

    foreach ($roles as $role) {
      if (Auth::guard($role)->check()) {
        return $role;
      }
    };

    return '';
  }
}