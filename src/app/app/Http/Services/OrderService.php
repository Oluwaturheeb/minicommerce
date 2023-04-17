<?php

namespace App\Http\Services;

use App\Jobs\CheckoutJob;
use App\Models\Items;
use App\Models\User;

class OrderService extends Service
{
  public function __construct() {
    $this->service = new OrderService();
  }
  public function store (Request $request) {
    
    CheckoutJob::dispatch()
  }
}
