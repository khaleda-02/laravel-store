<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); // this will return a Collection (special obj in php )
        // dd($categories);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource. -> just return the form , no creation here 
     */
    public function create()
    {
        $parents = Category::all(); // this will return a Collection (special obj in php )
        return view('dashboard.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage. gettting the form data , and crate new instance here 
     */
    public function store(Request $request)
    {
        //todo : validation 

        //! NOTE : access the request params 
        // $request->input('name');
        // $request->post('name');
        // $request->name;

        //! Note:  $request->all();  // this called mass assignment , (all filed will be pass to the model , even if it was not a property )
        // $request->only(['name', 'description']);
        // $request->except(['name', 'description']);

        //! NOTE : Request merge 
        $request->merge(['slug' => Str::slug($request->post('name'))]);


        //! NOTE : PRG -> POST - Redirect - Get , it's mean after the post done we have to redirect the user to get 
        //! (without using PRG ) user submit the form , back to the same page , if he submitted again it will create the same obj . 
        // so we solve this by change the post to get 

        $category = Category::create($request->all()); // NOTE this's mass assignment , solved in model , fillable 
        return Redirect::route('dashboard.categories.index');
    }

    /**
     * Display the specified resource. get the info for a specific record 
     */
    public function show(string $id)
    {
        return view('dashboard.categories.show');
    }

    /**
     * Show the form for editing the specified resource. , just the form 
     */
    public function edit(string $id)
    {
        return view('dashboard.categories.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('dashboard.categories.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('dashboard.categories.destroy');
    }
}
