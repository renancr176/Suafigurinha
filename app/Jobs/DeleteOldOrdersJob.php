<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\AlbumOrder;
use Illuminate\Support\Facades\Log;

class DeleteOldOrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Rotina de exclusão de pedidos completos antigos\nConfiguração de dias para exclusão => "+env('ORDER_EXPIRE_DAYS', 'Não definido'));

        if ($days = env('ORDER_EXPIRE_DAYS'))
        {
            if (is_int($days) && $days > 0)
            {
                $baseDate = gmdate("M d Y H:i:s", strtotime("-$days day"));

                $oldOrders = AlbumOrder::where('completed', true)
                ->where('deleted', false)
                ->where('updated_at', '<=', $baseDate)
                ->get();

                foreach($oldOrders as $order)
                {
                    foreach($order->files()->get() as $file)
                        if (Storage::disk(env('STORAGE', 'local'))->exists($file->path))
                            Storage::disk(env('STORAGE', 'local'))->delete($file->path);

                    $order->update([
                        'deleted' => true
                    ]);
                }
            }
        }
    }
}
