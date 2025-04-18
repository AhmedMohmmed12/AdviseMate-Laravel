<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appoinment;
use App\Models\TicketTypeDetails;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentStatusChanged;
use App\Mail\TicketCreated;
use App\Mail\TicketStatusChanged;
use App\Mail\ProfileUpdated;
use App\Mail\PasswordChanged;

class TestEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:emails {type=all} {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $testEmail = $this->argument('email') ?? config('mail.from.address');
        
        $this->info("Testing email notifications, sending to: $testEmail");
        
        if ($type === 'all' || $type === 'appointment') {
            $this->testAppointmentEmails($testEmail);
        }
        
        if ($type === 'all' || $type === 'ticket') {
            $this->testTicketEmails($testEmail);
        }
        
        if ($type === 'all' || $type === 'profile') {
            $this->testProfileEmails($testEmail);
        }
        
        $this->info('Email tests completed!');
    }
    
    protected function testAppointmentEmails($email)
    {
        $appointment = Appoinment::with(['student', 'advisor'])->first();
        
        if (!$appointment) {
            $this->error('No appointment found in the database!');
            return;
        }
        
        $this->info('Sending appointment created email...');
        Mail::to($email)->send(new AppointmentCreated($appointment));
        
        $this->info('Sending appointment status changed email...');
        Mail::to($email)->send(new AppointmentStatusChanged($appointment));
    }
    
    protected function testTicketEmails($email)
    {
        $ticket = TicketTypeDetails::with(['student', 'ticketType'])->first();
        
        if (!$ticket) {
            $this->error('No ticket found in the database!');
            return;
        }
        
        $this->info('Sending ticket created email...');
        Mail::to($email)->send(new TicketCreated($ticket));
        
        $this->info('Sending ticket status changed email...');
        Mail::to($email)->send(new TicketStatusChanged($ticket));
    }
    
    protected function testProfileEmails($email)
    {
        $student = Student::first();
        $advisor = User::role('advisor')->first();
        
        if (!$student || !$advisor) {
            $this->error('No student or advisor found in the database!');
            return;
        }
        
        $this->info('Sending profile updated email (student)...');
        Mail::to($email)->send(new ProfileUpdated($student, 'student'));
        
        $this->info('Sending profile updated email (advisor)...');
        Mail::to($email)->send(new ProfileUpdated($advisor, 'advisor'));
        
        $this->info('Sending password changed email (student)...');
        Mail::to($email)->send(new PasswordChanged($student, 'student'));
        
        $this->info('Sending password changed email (advisor)...');
        Mail::to($email)->send(new PasswordChanged($advisor, 'advisor'));
    }
} 