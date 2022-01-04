<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Lecturer extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'lecturers';

    protected $primaryKey = 'lecturer_id';

    protected $keyType = 'string';

    protected $hidden = [
        'password',
    ];
    
    public $incrementing = false;

    public function courses() {
        return $this->belongsToMany(Course::class, 'class_courses', 'lecturer_id', 'course_id');
    }
}
