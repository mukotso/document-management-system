<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Daniel Dantez',
            'department_id' => 0,
            'tel' => 2547089456,
            'status' => 'active',
            'role_id' => 1,
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
