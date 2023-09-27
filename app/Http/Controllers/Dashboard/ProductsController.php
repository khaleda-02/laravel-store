<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with(['store', 'category'])->paginate(20); 
        // $products = Product::paginate(); //!NOTE: heavy memory consuming (it's load all found data on memory) , too many select statements
        return view('dashboard.products.index', compact('products'));
    }


    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}
