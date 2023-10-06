<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repos\Cart\CartRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepo $cart) // laravel will get the value of CartRepo from the service container . 
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('front.carts.index', ['cart' => $this->cart]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $this->cart->add($request->product_id, $request->quantity);
        return Redirect::back();
    }


    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);
        $this->cart->update($request->product_id, $request->quantity);
    }

    //Todo test this function , using the product_id parameter, and if npt working use items cart_id . 
    public function destroy(string $id)
    {
        $this->cart->delete($id); // $id is the product_id 
        return Redirect::back();
    }
}
