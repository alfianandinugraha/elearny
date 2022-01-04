<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ClassCourseSeeder extends Seeder
{
    public static $items = [
        '299e3f0c-cb30-4d14-981a-3dcea6c8e73f',
        'ef07d35b-ed72-475e-8f78-298087221d78'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ClassCourseSeeder::$items as $item) {
            DB::table('class_courses')->insert(            [
                'class_course_id' =>$item,
                'lecturer_id' => '299e3f0c-cb30-4d14-981a-3dcea6c8e73f',
                'course_id' => 'e48a428c-cee3-42ef-ac96-d163daf9d939',
                'class' => 'A'
            ]);
        }
    }
}
