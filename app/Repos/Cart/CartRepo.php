<?php

namespace App\Repos\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepo
{
  public function get(): Collection;
  public function add($product_id, $quantity = 1);
  public function update($product_id, $quantity = 1);
  public function delete($product_id);
  public function empty();
  public function total(): float;
}
