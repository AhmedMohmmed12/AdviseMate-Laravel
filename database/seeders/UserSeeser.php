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
            'mobileNumber' => '0553201234',
            'password' => bcrypt(123123)    
        ])->assignRole('super_admin');

        User::create([
            'fName' => "ali",
            'lName'  => "mohmmed" ,
            'email' => "advisemate1@gmail.com",
            'gender' => 'male',
            'mobileNumber' => '0553201231',
            'password' => bcrypt(123123)    
        ])->assignRole('advisor');
    }
}
