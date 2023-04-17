<?php

namespace App\Http\Services;

use App\Models\Cart;
use App\Models\Items;
use App\Models\User;

class CartService extends Service
{
  public function addItemToCart($user, $item, $quantity)
  {
    app('App\Job\AddToCart', func_get_args());
  }

  public function getCartItems()
  {
    $user = auth()->user();
    return $user->cart()->where('status', null)->get();
  }

  public function getTotalCartItems()
  {
    $items = $this->getCartItems();
    $price = 0;
    foreach($items as $item) {
      $q = $item->quantity;
      $item = $item->item;
      $amount = $item->amount - ($item->discount / 100) * $item->amount;
      $price += ($item->discount ? $amount : $item->amount) * $q;
    }

    return $this->formattedResponse(
      status: 'Success',
      message: '',
      data: [
        'cartTotal' => $price,
        'cartItems' => count($items),
      ]
    );
  }

  public function deleteCartItem ($user, $item) {
    Cart::where([
      ['user_id', '=', $user],
      ['item_id', '=', $item],
    ])->delete();

    return $this->formattedResponse('success', 'Item has been removed successfully!');
  }

  public function getAddress () {
    $address = auth()->user()->address;
    return $this->formattedResponse(
      status: 'Success',
      message: '',
      data: $address
    );
  }
}
