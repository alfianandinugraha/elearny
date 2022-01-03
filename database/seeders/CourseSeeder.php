<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->truncate();
        
        $faker = Factory::create();
        $courses = [
            [
                'course_id' => 'MPPL',
                'name' => 'Metode Pengembangan Aplikasi',
                'description' => $faker->text(100),
                'semester' => 6
            ],
            [
                'course_id' => 'RTI',
                'name' => 'Riset Teknologi dan Informasi',
                'description' => $faker->text(100),
                'semester' => 6
            ],
            [
                'course_id' => 'PROMOB',
                'name' => 'Pemrograman Mobile',
                'description' => $faker->text(100),
                'semester' => 6
            ]
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert($course);
        }
    }
}
