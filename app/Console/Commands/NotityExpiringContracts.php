<?php

namespace App\Console\Commands;

use App\Mail\ExpiringContractsEmail;
use App\Models\Contract;
use Illuminate\Console\Command;
use Mail;

class NotifyExpiringContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-expiring-contracts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for notify expiring in 3 months contracts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Contract::where('end_date', '>', now()->addMonths(3))->each(function ($contract) {
            Mail::to($contract->lessor->email)->send(new ExpiringContractsEmail());
            Mail::to($contract->lessee->email)->send(new ExpiringContractsEmail());
        });
    }
}
