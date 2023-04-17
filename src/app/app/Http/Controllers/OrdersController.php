<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\IndexService;
use App\Jobs\CheckoutJob;
use App\Models\Cart;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new IndexService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        //     $res = Http::withToken(env('PAYSTACK_SK'))
        //         ->get("https://api.paystack.co/transaction/verify/{$request->reference}");

            // $ref = (object) $res->json()['data'];
            // $amount = $ref->amount;
            $cart = new CartService();

            // if ($amount / 100 === $cart->getTotalCartItems()->data['cartTotal']) {
                CheckoutJob::dispatch(auth()->user()->id, $request->address, $cart->getCartItems(), $request->reference);
                $this->completeOrder();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order has been placed successfully!',
                ]);
            // } else {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Cannot complete order, contact support!',
            //     ]);
            // }
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => '222222222222Cannot complete order, contact support!',
        //     ]);
        // }
    }

    public function completeOrder()
    {
        $items = array_map(function ($key){
            return $key['item_id'];
        }, (new CartService())->getCartItems()->toArray());

        Cart::where('user_id', auth()->user()->id)->whereIn('item_id', $items)->update(['status' => 1]);
    }
}
