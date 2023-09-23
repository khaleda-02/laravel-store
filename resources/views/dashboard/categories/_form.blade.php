@foreach ($errors as $error)
    <div class="danger">
        <p class="danger">{{ $error->first() }}</p>
    </div>
@endforeach

<div class="form-group">
    <x-form.input title="Category Name " type='text' name="name" :value="$category->name" />
</div>

<div class="form-group">
    <label> Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category </option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <x-form.textarea title="Category Description" name="description" :value="$category->description" />
</div>


<div class="form-group">
    <label> Category status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="active" value="active"
            @checked(old('status', $category->status) == 'active')>
        <label class="form-check-label" for="active">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="archive" value="archived"
            @checked(old('status', $category->status) == 'archived')>
        <label class="form-check-label" for="archive">
            Archive
        </label>
    </div>
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
