<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassCourseController extends Controller
{
    public function get() {
        return view('pages.admin.classes.main');
    }
}
