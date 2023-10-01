<div class="form-group">
    <x-form.input title="Product Name" type='text' name="name" value="{{ $product->name }}" />
</div>

<div class="form-group">
    <label> Product Category</label>
    <select name="category_id" class="form-control form-select">
        @foreach (App\Models\Category::all() as $category)
            <option value={{ $category->id }} @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label> Product Store</label>
    <select name="store_id" class="form-control form-select">
        @foreach (App\Models\Store::all() as $store)
            <option value={{ $store->id }} @selected(old('store_id', $product->store_id) == $store->id)>{{ $store->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <x-form.textarea title="Product Description" name="description" value="{{ $product->description }}" />
</div>

<div class="form-group">
    <x-form.input title="Price" name="price" value="{{ $product->price }}" />
</div>

<div class="form-group">
    <x-form.input title="compare price" name="compare_price" value="{{ $product->compare_price }}" />
</div>

<div class="form-group">
    <x-form.input title="tags" name="tags" value="{{ $tags }}" />
</div>


<div class="form-group">
    <label> Product status</label>
    <x-form.status-radio :options="['active', 'draft', 'archived']" checked="{{ $product->status }}" />
</div>

<div class="form-group">
    <x-form.input title="Product image" type='file' name="image" />
</div>
@if ($product->image)
    <div class="mb-5">
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="50">
    </div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_name ?? 'submit' }}</button>
</div>
