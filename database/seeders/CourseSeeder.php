<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CourseSeeder extends Seeder
{
    public static $courses = [
        [
            'course_id' => '61d5b18ad1156',
            'code' => 'MPPL',
            'name' => 'Metode Pengembangan Aplikasi',
            'description' => 'Provident blanditiis ea et quia provident ut eum similique. Quidem enim vel iste quo.',
            'semester' => 6
        ],
        [
            'course_id' => '61d5b18ad1157',
            'code' => 'RTI',
            'name' => 'Riset Teknologi dan Informasi',
            'description' => 'Ut quas aspernatur voluptatum quam aliquam. Aliquam sequi aut suscipit perferendis rerum optio qui.',
            'semester' => 6
        ],
        [
            'course_id' => '61d5b18ad1158',
            'code' => 'PROMOB',
            'name' => 'Pemrograman Mobile',
            'description' => 'Consequatur corporis facilis voluptatem et. Qui cum quisquam minus rem consequatur iure qui.',
            'semester' => 6
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->truncate();

        foreach (CourseSeeder::$courses as $course) {
            DB::table('courses')->insert($course);
        }
    }
}
