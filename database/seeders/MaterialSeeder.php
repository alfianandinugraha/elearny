<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->truncate();

        DB::table('materials')
            ->insert([
                'material_id' => uniqid(),
                'title' => Factory::create()->text(20),
                'content' => Factory::create()->realText(5000),
                'filename' => 'example_61d5b18ad1157.pdf',
                'class_course_id' => ClassCourseSeeder::$items[0]
            ]);

        foreach(ClassCourseSeeder::$items as $item) {
            DB::table('materials')
                ->insert([
                    'material_id' => uniqid(),
                    'title' => Factory::create()->text(20),
                    'content' => Factory::create()->realText(5000),
                    'filename' => 'example_61d5b18ad1157.pdf',
                    'class_course_id' => $item
                ]);
        }
    }
}
