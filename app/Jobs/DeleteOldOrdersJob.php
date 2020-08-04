<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\AlbumOrder;

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
                        if (Storage::disk('local')->exists($file->path))
                            Storage::disk('local')->delete($file->path);

                    $order->update([
                        'deleted' => true
                    ]);
                }
            }
        }
    }
}
