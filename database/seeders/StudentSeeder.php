<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->truncate();

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
