<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call([
            AdminSeeder::class,
            StudentSeeder::class,
            LecturerSeeder::class,
            CourseSeeder::class,
            ClassCourseSeeder::class,
            StudentCourseSeeder::class,
            MaterialSeeder::class
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
