<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lecturers')->truncate();

        DB::table('lecturers')->insert([
            'lecturer_id' => '299e3f0c-cb30-4d14-981a-3dcea6c8e73f',
            'lecturer_number' => '1112817380',
            'password' => Hash::make('hello'),
            'email' => 'shanny.tromp@braun.com',
            'fullname' => 'Frederick Schulist',
            'gender' => 'male'
        ]);

        for($i = 1; $i <= 3; $i++) {
            $faker = Factory::create();

            DB::table('lecturers')->insert([
                'lecturer_id' => Uuid::uuid4(),
                'lecturer_number' => '111281738' . $i,
                'password' => Hash::make('hello'),
                'email' => $faker->email(),
                'fullname' => $faker->name(),
                'gender' => 'male'
            ]);
        }
    }
}
