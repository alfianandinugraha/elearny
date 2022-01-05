<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_courses')->truncate();

        foreach (StudentSeeder::$items as $item) {
            DB::table('student_courses')->insert([
                'student_course_id' => uniqid(),
                'class_course_id' => ClassCourseSeeder::$items[0],
                'student_id' => $item
            ]);
        }
    }
}