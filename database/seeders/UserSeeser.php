<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fName' => "superadmin",
            'lName'  => "test" ,
            'email' => "superadmin@advisemate.com",
            'gender' => 'male',
            'password' => bcrypt(123123)    
        ])->assignRole('super_admin');
    }
}
