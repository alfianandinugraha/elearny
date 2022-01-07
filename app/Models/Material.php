<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Material extends Model
{
    use HasFactory;

    protected $primaryKey = "material_id";

    protected $table = "materials";

    protected $keyType = "string";

    protected $fillable = [
        'material_id',
        'title',
        'content',
        'filename',
        'class_course_id'
    ];

    static function detail($materialId) {
        $material = DB::table("materials")
            ->where('materials.material_id', $materialId)
            ->join('class_courses', 'class_courses.class_course_id', '=', 'materials.class_course_id')
            ->join('courses', 'class_courses.course_id', '=', 'courses.course_id')
            ->get([
                "materials.title", "materials.content", "materials.filename", "materials.material_id", "courses.name AS course_name", "class_courses.class_course_id" 
            ])
            ->first();

        return $material;
    }
}
