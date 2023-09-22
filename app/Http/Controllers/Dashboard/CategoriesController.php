<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $category = new Category(); // empty category for _form in create.blade.php
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage. gettting the form data , and crate new instance here 
     */
    public function store(Request $request)
    {

        //validation 
        $request->validate(Category::rules(true)); //NOTE : this validation fun return the checked data (just : name , parent_id , status , image)

        $request->merge(['slug' => Str::slug($request->post('name'))]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        Category::create($data);
        return Redirect::route('dashboard.categories.index');
    }

    /**
     * Display the specified resource. get the info for a specific record 
     */
    public function show(string $id)
    {
        // return view('dashboard.categories.show');
    }

    /**
     * Show the form for editing the specified resource. , just the form 
     */
    public function edit(string $id)
    {
        //! this query just will prevent the first level children 
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '!=', $id)
            ->where('parent_id', '!=', $category->id)
            ->get();
        //! NOTE: adding OR in the select query , orwhere instead of where 
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules(false));

        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');
        $new_path = $this->uploadImage($request);
        if ($new_path)
            $data['image'] = $new_path;

        $category->update($data);

        //todo delete the image from public using the right disk 
        if ($old_image && isset($data['image'])) {
            // verify if the category was having an image , and it's different from the new image .
            Storage::delete($old_image); // we cab specify the disk that we wanna to delete from , by this code :Storage::disk('local')->delete($old_image);
        }

        return Redirect::route('dashboard.categories.index');


        // $category->fill($request->all())->save();
        // fill => just change the category obj here, nad don't reflect in db 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // NOTE : we still have the category object , even after the deletion , 
        // and we put the image deletion after the category deletion , so if something happened and the category didn't delete , we don't need to delete the imag      
        if ($category->image) {
            Storage::delete($category->image);
        }
        return Redirect::route('dashboard.categories.index');
    }


    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) return;
        $path  = $request->file('image')
            ->store('uploads', 'public');
        return $path;
    }
}
