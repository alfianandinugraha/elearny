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

        for($i = 0; $i < 3; $i++) {
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
