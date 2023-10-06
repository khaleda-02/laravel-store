<?php

namespace App\Repos\Cart;

use App\Models\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartModelRepo implements CartRepo
{
  public function get(): Collection
  {

    return Cart::with('product')->get();
  }

  public function add($product_id, $quantity = 1)
  {
    $item =  Cart::where('product_id', '=', $product_id)
      ->first();
    if (!$item) {
      $cart = Cart::create([
        'user_id' => Auth::id(),
        'product_id' => $product_id,
        'quantity' => $quantity,
      ]);
      return $cart;
    }

    return $item->increment('quantity', $quantity);
    // $cart = Cart::updateOrCreate(
    //   ['product_id' => $product_id],
    //   ['user_id' => Auth::id(), 'quantity' =>  DB::raw('quantity + ' . $quantity)]
    // );
  }

  public function update($product_id, $quantity = 1)
  {
    Cart::where('product_id', $product_id)
      ->update([
        'quantity' => $quantity,
      ]);
  }

  public function delete($product_id)
  {
    // dd($product_id);
    Cart::where('product_id', $product_id)->delete();
  }

  public function empty()
  {
    Cart::query()->delete();
  }

  public function total(): float
  {
    // Cart::join('products', 'products.id', '=', 'carts.product_id')
    //   ->selectRaw('sum(product.price * carts.quantity) as total ')
    //   ->value('total');
    return $this->get()->sum(function ($item) {
      return $item->quantity * $item->product->price;
    });
  }
}

//my_NOTE: to create a new cookie in laravel ,
// 1- in the response , but in our case we need to create a new cookie but not in the response 
// 2- in the cookie queue 
