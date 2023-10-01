<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    //!NOTE: Eger loading heavy memory consuming (it's load all found data on memory) , too many select statements
    public function index()
    {
        $products = Product::with(['store', 'category'])->paginate(20);
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

    public function edit(Product $product)
    {
        $tags = $product->tags;
        return view('dashboard.products.edit', compact(['product', 'tags']));
    }

    public function update(Request $request, Product $product)
    {
        //todo $request->validate();
        $product->update($request->all());
        return Redirect::route('dashboard.products.index');
    }

    public function destroy(string $id)
    {
    }
}
