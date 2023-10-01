<div class="form-group">
    <x-form.input title="Category Name" type='text' name="name" value="{{ $category->name }}" />
</div>

<div class="form-group">
    <label> Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category </option>
        @foreach ($parents as $parent)
            <option value={{ $parent->id }} @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <x-form.textarea title="Category Description" name="description" value="{{ $category->description }}" />
</div>


<div class="form-group">
    <label> Category status</label>
    <x-form.status-radio :options="['active', 'archived']" value="{{ $category->status }}" checked="{{ $category->status }}" />
</div>

<div class="form-group">
    <x-form.input title="Category image" type='file' name="image" />
</div>
@if ($category->image)
    <div class="mb-5">
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
    </div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_name ?? 'submit' }}</button>
</div>
