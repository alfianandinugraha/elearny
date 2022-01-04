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
                'course_id' => '1fd47d96-a568-4632-bfb0-a533207a2c91',
                'code' => 'MPPL',
                'name' => 'Metode Pengembangan Aplikasi',
                'description' => $faker->text(100),
                'semester' => 6
            ],
            [
                'course_id' => 'd11e4389-dd38-4026-a132-0177093a47b1',
                'code' => 'RTI',
                'name' => 'Riset Teknologi dan Informasi',
                'description' => $faker->text(100),
                'semester' => 6
            ],
            [
                'course_id' => 'e48a428c-cee3-42ef-ac96-d163daf9d939',
                'code' => 'PROMOB',
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
