<?php

namespace App\Jobs;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckoutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user, $address, $items, $ref;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $address, $items, $ref)
    {
        $this->user = $user;
        $this->address = $address;
        $this->items = $items;
        $this->ref = $ref;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $items = [];
        foreach($this->items as $item) {
            $itemInfo = $item->item;
            $items[] = [
                'user_id' => $this->user,
                'address' => $this->address,
                'item_name' => $itemInfo->item_name,
                'amount' => $itemInfo->discount
                    ? $itemInfo->amount * ($itemInfo->discount / 100) * $item->quantity
                    : $itemInfo->amount * $item->quantity,
                'description' => $itemInfo->description,
                'quantity' => $item->quantity,
                'picture' => $itemInfo->picture,
                'payment_ref' => $this->ref,
            ];
        }
        Orders::createOrder($items);
    }
}
