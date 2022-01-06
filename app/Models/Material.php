<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $primaryKey = "material_id";

    protected $table = "materials";

    protected $typeKey = "string";

    protected $fillable = [
        'material_id',
        'title',
        'content',
        'filename',
        'class_course_id'
    ];
}
