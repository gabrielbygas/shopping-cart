<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailySalesReport extends Command
{
    protected $signature = 'sales:report-daily'; // The command name
    protected $description = 'Send a daily sales report to the admin';

    public function handle()
    {
        // Retrieve items added today
        $itemsToday = Cart::with('product')
            ->whereDate('created_at', Carbon::today())
            ->get();

        $totalSales = $itemsToday->sum(fn($item) => $item->product->price * $item->quantity);
        $itemCount = $itemsToday->count();

        $content = "Sales Report for " . Carbon::today()->format('m/d/Y') . "\n";
        $content .= "Number of items added: " . $itemCount . "\n";
        $content .= "Estimated total value: " . number_format($totalSales, 2) . " $";

        Mail::raw($content, function ($message) {
            $message->to('gabrielkalala@protonmail.com')->subject('Daily Sales Report');
        });

        $this->info('Report sent successfully!');
    }
}