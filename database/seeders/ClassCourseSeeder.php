<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ClassCourseSeeder extends Seeder
{
    public static $items = [
        '61d5b18ad1154',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_courses')->truncate();

        DB::table('class_courses')->insert([
            'class_course_id' => uniqid(),
            'lecturer_id' => '299e3f0c-cb30-4d14-981a-3dcea6c8e73f',
            'course_id' => 'd11e4389-dd38-4026-a132-0177093a47b1',
            'class' => 'B'
        ]);

        foreach (ClassCourseSeeder::$items as $item) {
            DB::table('class_courses')->insert(            [
                'class_course_id' => $item,
                'lecturer_id' => '299e3f0c-cb30-4d14-981a-3dcea6c8e73f',
                'course_id' => '1fd47d96-a568-4632-bfb0-a533207a2c91',
                'class' => 'A'
            ]);
        }
    }
}
