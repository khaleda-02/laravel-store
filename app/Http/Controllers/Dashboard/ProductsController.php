<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    //!my_NOTE: Eger loading heavy memory consuming (it's load all found data on memory) , too many select statements
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
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        // dd($tags);
        // without pluck -> we will get the tags obj , so to get just the name of the obj , use pluck 
        return view('dashboard.products.edit', compact(['product', 'tags']));
    }

    public function update(Request $request, Product $product)
    {
        //todo $request->validate();
        $tags = explode(',', $request->tags);
        $tag_ids = [];

        foreach ($tags as $tag_name) {
            $tag_slug = Str::slug($tag_name);
            $tag = Tag::updateOrCreate(
                ['slug' => $tag_slug],
                ['name' => $tag_name]
            );
            $tag_ids[] = $tag->id;
        }


        $product->update($request->except('tags'));
        $product->tags()->sync($tag_ids);
        //my_NOTE: we can use attach instead of sync in case we need to attach add , and the db will return an error in case the tag is exists already 
        //my_NOTE: detach for removing , syncWithoutDetaching for add without remove .(attach alternative) 
        return Redirect::route('dashboard.products.index');
    }

    public function destroy(string $id)
    {
    }
}
