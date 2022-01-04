<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $primaryKey = 'course_id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function lecturers() {
        return $this->belongsToMany(Lecturer::class, 'class_courses', 'course_id', 'lecturer_id');
    }
}
