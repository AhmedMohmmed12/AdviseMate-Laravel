<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
USE Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'super_admin',
            'guard_name' => 'web'
        ]);
        
        Role::create([
            'name' => 'advisor',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'student',
            'guard_name' => 'student'
        ]);
    }
}
