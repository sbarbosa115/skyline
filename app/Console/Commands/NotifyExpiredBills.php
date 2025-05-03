<?php

namespace App\Console\Commands;

use App\Mail\ExpiredBillsEmail;
use App\Models\Bill;
use Illuminate\Console\Command;
use Mail;

class NotifyExpiredBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-expired-bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for notify expired bills';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredBills = Bill::where('status', Bill::STATUS_SENT)
            ->where('period_to', '<', now())
            ->get();

        foreach ($expiredBills as $bill) {
            $activeContract = $bill->subProperty->activeContract;
            if ($activeContract === null) {
                $this->error('The sub property has no active contract: '.$bill->subProperty->id);
            }

            Mail::to($activeContract->lessor->email)->send(new ExpiredBillsEmail());
            Mail::to($activeContract->lessee->email)->send(new ExpiredBillsEmail());
        }
    }
}
