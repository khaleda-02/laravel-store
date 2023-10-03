<?php

namespace App\Repos\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRepo implements CartRepo
{
  public function get(): Collection
  {
    return Cart::all();
  }

  public function add(Product $product, $quantity = 1)
  {
    Cart::create([
      'user_id' => Auth::id(),
      'product_id' => $product->id,
      'quantity' => $quantity
    ]);
  }

  public function update(Product $product, $quantity = 1)
  {
    Cart::where('product_id', $product->id)
      ->update([
        'quantity' => $quantity,
      ]);
  }

  public function delete(Product $product)
  {
    Cart::where('product_id', $product->id)->delete();
  }
  public function empty()
  {
    // Cart::delete();
  }
  public function total(): float
  {
    return 123.2;
    Cart::join('products', 'products.id', '=', 'carts.product_id')
      ->selectRaw('sum(product.price * carts.quantity) as total ')
      ->value('total');
  }

  //? helper methods 
  protected function getCookieId()
  {
    $cookie_id = Cookie::get('cart_id');
     
  }
}

//my_NOTE: to create a new cookie in laravel ,
// 1- in the response , but in our case we need to create a new cookie but not in the response 
// 2- in the cookie queue 
