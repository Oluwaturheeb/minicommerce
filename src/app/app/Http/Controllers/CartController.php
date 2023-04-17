<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Jobs\AddToCartJob;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public $service;

    public function __construct()
    {
        $this->service = new CartService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = $this->service->getCartItems();
        $cart = $this->service->getTotalCartItems()->data;

        return view('cart', ['items' => $cartItems, 'cart' => $cart]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $address = $this->service->getAddress()->data;
        $cartItems = $this->service->getCartItems();
        $cart = $this->service->getTotalCartItems()->data;
        return view('checkout', compact('address', 'cart', 'cartItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'int|required|min:1',
            'cart_item' => 'int|required'
        ]);

        AddToCartJob::dispatch(1, $request->cart_item, $request->quantity);
        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $item = $this->service->deleteCartItem(auth()->user()->id, $request->item);

        if ($item->status == 'success') {
            return back()->with('cart', $item->message);
        } else {
            return back()->with('cart', 'Unknown error, try again.');
        }
    }
}
