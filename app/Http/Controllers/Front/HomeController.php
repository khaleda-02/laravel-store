<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->limit(8)->get();
        $products = Product::active()
            ->latest('id')
            ->limit(8)
            ->with(['category'])
            ->get();
        // dd($products);
        return view('front.index', compact(['products']));
    }
}
