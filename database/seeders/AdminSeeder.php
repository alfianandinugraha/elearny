<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            'admin_id' => Uuid::uuid4(),
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'fullname' => 'Admin Hello'
        ]);
    }
}
