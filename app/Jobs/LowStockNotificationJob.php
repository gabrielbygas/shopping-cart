<?php

namespace App\Jobs;

use App\Mail\LowStockNotificationMail;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LowStockNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        // Envoyer un email à l'admin (remplace "admin@example.com" par l'email réel)
        Mail::to('gabrielkalala@protonmail.com')
            ->send(new LowStockNotificationMail($this->product));
    }
}