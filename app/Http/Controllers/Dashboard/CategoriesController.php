<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $request = request();

        $categories = Category::
            // with('parent') // using model's relation 
            leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select(['categories.*', 'parents.name as parent_name'])
            ->withCount([
                'products as products_num' => function ($query) {
                    $query->where('status', '=', 'active');
                }
            ])
            //NOTE: ->selectRaw('(select count(*) from products where products.id = categories.id) as products_num')
            ->filter($request->query())
            ->latest()
            ->paginate(); // this will return a Collection (special obj in php )
        return view('dashboard.categories.index', compact('categories'));
        // $categories = Category::simplePaginate(4); NOTE : just in case we want to show (previous , next) instead of  showing the page numbers .
    }

    public function show(Category $category)
    {
        // $products = $category->products()->with(['store'])->paginate();
        $products = $category->products()->with(['store'])->paginate();
        // dd($products);
        return view('dashboard.categories.show', compact(['products', 'category']));

        //! $category->products() => return the relation ojb , which's mean that we can add more queries to it 
        //! $category->products => will return the obj (category || product || store ) MODEL , [query on db , check if there's a relation , if yes return the obj ]
        //! eger
    }

    public function create()
    {
        $parents = Category::all();
        $category = new Category(); // empty category for _form in create.blade.php
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    public function store(Request $request)
    {
        $request->validate(Category::rules()); //NOTE : this validation fun return the checked data (just : name , parent_id , status , image)

        $request->merge(['slug' => Str::slug($request->post('name'))]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        Category::create($data);
        return Redirect::route('dashboard.categories.index');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '!=', $id)
            ->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

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


        // NOTE : $category->fill($request->all())->save();
        // fill => just change the category obj here, nad don't reflect in db 
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return Redirect::route('dashboard.categories.index');
    }

    public function trash(Request $request)
    {
        $categories = Category::onlyTrashed()
            ->filter($request->query())
            ->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return Redirect::route('dashboard.categories.trash');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        // NOTE : we still have the category object , even after the deletion , 
        // and we put the image deletion after the category deletion , so if something happened and the category didn't delete , we don't need to delete the imag      
        if ($category->image) {
            Storage::delete($category->image);
        }
        return Redirect::route('dashboard.categories.trash');
    }

    //? HELPERS 
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) return;
        $path  = $request->file('image')
            ->store('uploads', 'public');
        return $path;
    }
}
