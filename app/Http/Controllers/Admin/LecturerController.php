<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function get() {
        $lecturers = Lecturer::all();
        return view('pages.admin.lecturer.main', [
            'lecturers' => $lecturers,
        ]);
    }
}
