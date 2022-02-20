<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //super admin
        DB::table('permissions')->insert([
            'role_id' => 1,
            'permission'=>'can create/view/edit/delete users',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 1,
            'permission'=>'can create/view/edit/delete departments',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 1,
            'permission'=>'can view system analytics ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 1,
            'permission'=>'can view his/her roles and permissions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 1,
            'permission'=>'can view his/her profile',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 1,
            'permission'=>'can logout of the system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //manager
        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can create/view/edit/delete users',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can create/view/edit/delete documents',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can view document history',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can view Document Access Requests',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can view system analytics ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can view his/her roles and permissions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can view his/her profile',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 2,
            'permission'=>'can logout of the system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        //analyst

        DB::table('permissions')->insert([
            'role_id' => 3,
            'permission'=>'can create/view/edit/delete documents',
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        DB::table('permissions')->insert([
            'role_id' => 3,
            'permission'=>'can create Document Access Requests',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('permissions')->insert([
            'role_id' => 3,
            'permission'=>'can view his/her roles and permissions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 3,
            'permission'=>'can view his/her profile',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 3,
            'permission'=>'can logout of the system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //below analyst

        DB::table('permissions')->insert([
            'role_id' => 4,
            'permission'=>'can create/view/edit/delete documents',
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        DB::table('permissions')->insert([
            'role_id' => 4,
            'permission'=>'can create Document Access Requests',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('permissions')->insert([
            'role_id' => 4,
            'permission'=>'can view his/her roles and permissions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('permissions')->insert([
            'role_id' => 4,
            'permission'=>'can view his/her profile',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'role_id' => 4,
            'permission'=>'can logout of the system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
