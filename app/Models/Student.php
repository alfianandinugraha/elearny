<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $primaryKey = 'student_id';

    protected $keyType = 'string';

    protected $fillable = [
        'student_id',
        'student_number',
        'fullname',
        'email',
        'password',
        'gender'
    ];
}
