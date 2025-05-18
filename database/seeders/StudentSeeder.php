<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Student::create([
                'Fname' => "ahmed",
                'LName'  => "mohammed" ,
                'email' => "ahmedmohmmed200212@gmail.com",
                'gender' => 'male',
                'program'=> 'Computer Science',
                'phoneNumber' => '0553201235',
                'password' => bcrypt('123456')    
            ])->assignRole('student');
        }
    }
}
