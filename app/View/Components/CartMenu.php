<?php

namespace App\View\Components;

use App\Repos\Cart\CartRepo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $cart;
    public $cartItems;
    public function __construct(CartRepo $cart)
    {
        $this->cart = $cart;
        $this->cartItems = $cart->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
