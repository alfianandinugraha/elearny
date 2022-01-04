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
}
