<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ClassCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classCourses = [
            [
                'class_course_id' => Uuid::uuid4(),
                'lecturer_id' => '299e3f0c-cb30-4d14-981a-3dcea6c8e73f',
                'course_id' => 'MPPL',
                'class' => 'A'
            ]
        ];

        foreach ($classCourses as $classCourse) {
            DB::table('class_courses')->insert($classCourse);
        }
    }
}
