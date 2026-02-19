<?php

namespace App\Console\Commands;

use App\Jobs\UpdatePaymentStatusJob;
use App\Models\Payment;
use Illuminate\Console\Command;

class SyncPendingPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:sync-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza pagamentos pendentes no Mercado Pago';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Payment::where('status', 'pending')
            ->chunkById(50, function ($payments) {
                foreach ($payments as $payment) {
                    UpdatePaymentStatusJob::dispatch(
                        $payment->external_payment_id
                    );
                }
            });

        $this->info('Pagamentos pendentes enviados para atualização.');
    }
}
