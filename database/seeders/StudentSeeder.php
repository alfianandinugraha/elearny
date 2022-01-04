<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class StudentSeeder extends Seeder
{
    public static $items = [
        '06d912e8-e847-4a2f-a720-f3d9e4c378f8',
        '0e4aa8eb-b9ab-4b79-8e47-8508dad94fad',
        '393bc648-10f1-491f-8721-ffb1ac3e9408'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->truncate();

        $i = 0;
        foreach (StudentSeeder::$items as $uuid) {
            DB::table('student')->insert([
                'student_id' => $uuid,
                'student_number' => "519041200$i",
                'password' => Hash::make('hello'),
                'email' => Factory::create()->email(),
                'fullname' => Factory::create()->name(),
                'gender' => 'male'
            ]);

            $i++;
        }


        for($i = 0; $i < 10; $i++) {
            $faker = Factory::create();

            DB::table('student')->insert([
                'student_id' => Uuid::uuid4(),
                'student_number' => '519041100' . $i,
                'password' => Hash::make('hello'),
                'email' => $faker->email(),
                'fullname' => $faker->name(),
                'gender' => 'male'
            ]);
        }
    }
}
