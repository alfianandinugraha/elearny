<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    use HasFactory;

    protected $table = 'class_courses';

    protected $primaryKey = 'class_course_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'class',
        'token',
        'lecturer_id',
        'class_course_id',
        'course_id'
    ];

    public static $classes = ['A', 'B', 'C', 'D'];

    public static function checkClass($courseId, $class) {
        return ClassCourse::query()
            ->where('course_id', $courseId,)
            ->where('class', $class)
            ->get(['class_course_id'])
            ->first();
    }
}
