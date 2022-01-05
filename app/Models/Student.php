<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

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
