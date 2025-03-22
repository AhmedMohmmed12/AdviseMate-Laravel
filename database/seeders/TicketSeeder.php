<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketType::create([
            'ticket_type' => 'Add Course',
            'updated_at' => now(),
            'created_at' => now()
            
        ]);

        TicketType::create([
            'ticket_type' => 'Drop Course',
            'updated_at' => now(),
            'created_at' => now()
            
        ]);

        TicketType::create([
            'ticket_type' => 'Withdrawn from Semester',
            'updated_at' => now(),
            'created_at' => now()
            
        ]);

        TicketType::create([
            'ticket_type' => 'Withdrawn from course',
            'updated_at' => now(),
            'created_at' => now()
            
        ]);

        TicketType::create([
            'ticket_type' => 'Postponed',
            'updated_at' => now(),
            'created_at' => now()
            
        ]);

        TicketType::create([
            'ticket_type' => 'Retreating',
            'updated_at' => now(),
            'created_at' => now()
            
        ]);

        TicketType::create([
            'ticket_type' => 'Appolgies from apsent exam',
            'updated_at' => now(),
            'created_at' => now()
        ]);
    }
}
