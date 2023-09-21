@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">categories</a></li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label> Category Name </label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label> Category Parent</label>
            <select name="parent_id" class="form-control form-select">
                <option value="">Primary Category </option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label> Category Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>


        <div class="form-group">
            <label> Category status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="archive" value="archived">
                <label class="form-check-label" for="archive">
                    Archive
                </label>
            </div>
        </div>

        <div class="form-group">
            <label> Category image</label>
            <input type="file" name="image" class="form-control" />
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>

    </form>
@endSection
