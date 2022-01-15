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

    protected $fillable = [
        'course_id',
        'name',
        'description',
        'semester',
        'code'
    ];

    public static $semesters = [1, 2, 3, 4, 5, 6, 7, 8];

    public function lecturers() {
        return $this->belongsToMany(Lecturer::class, 'class_courses', 'course_id', 'lecturer_id');
    }
}
