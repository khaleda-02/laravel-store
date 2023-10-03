<?php

namespace App\Repos\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepo
{
  public function get(): Collection;
  public function add(Product $product, $quantity = 1);
  public function update(Product $product, $quantity = 1);
  public function delete(Product $product);
  public function empty();
  public function total(): float;
}
