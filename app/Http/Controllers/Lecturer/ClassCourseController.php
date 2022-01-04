<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassCourseController extends Controller
{
    public function get() {
        return view('pages.lecturer.classes.main');
    }
}
