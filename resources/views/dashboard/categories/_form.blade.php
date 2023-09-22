<div class="form-group">
    <label> Category Name </label>
    <input type="text" name="name" @class(['form-control', 'is-invalid' => $errors->has('name')]) value="{{ $category->name }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label> Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category </option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label> Category Description</label>
    <textarea name="description" class="form-control">{{ $category->description }}</textarea>
</div>


<div class="form-group">
    <label> Category status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="active" value="active"
            @checked($category->status == 'active')>
        <label class="form-check-label" for="active">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="archive" value="archived"
            @checked($category->status == 'active')>
        <label class="form-check-label" for="archive">
            Archive
        </label>
    </div>
</div>

<div class="form-group">
    <label> Category image</label>
    <input type="file" name="image" class="form-control" />
</div>
@if ($category->image)
    <div class="mb-5">
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
    </div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_name ?? 'submit' }}</button>
</div>
