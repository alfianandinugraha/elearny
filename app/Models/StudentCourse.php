<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    protected $table = "student_courses";

    protected $primaryKey = "student_course_id";

    protected $keyType = "string";

    protected $fillable = [
        "student_course_id",
        "class_course_id",
        "student_id"
    ];
}
