<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appoinment;
use App\Models\TicketTypeDetails;
use Carbon\Carbon;

class ArchiveOldRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:old-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archives tickets and appointments older than 30 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        // Archive old appointments
        $appointmentsCount = Appoinment::where('app_date', '<', $thirtyDaysAgo)
            ->where('is_archived', false)
            ->update(['is_archived' => true]);

        // Archive old tickets
        $ticketsCount = TicketTypeDetails::where('created_at', '<', $thirtyDaysAgo)
            ->where('is_archived', false)
            ->update(['is_archived' => true]);

        $this->info("Archived $appointmentsCount appointments and $ticketsCount tickets.");

        return Command::SUCCESS;
    }
}
