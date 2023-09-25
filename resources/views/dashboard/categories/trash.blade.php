@extends('layouts.dashboard')

@section('title', 'Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">categories</a></li>
    <li class="breadcrumb-item"><a href="#">trash</a></li>
@endsection


@section('content')

    <div class="mb-3">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">categories</a>
    </div>

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-center">
        <x-form.input name="name" :value="request('name')" placeholder="category name" class="form-control mx-2" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>active</option>
            <option value="archived" @selected(request('status') == 'archived')>archived</option>
        </select>
        <button class="btn btn-dark" class="form-control mx-2">search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>name</th>
                <th>status</th>
                <th>created at </th>
                <th>delete at </th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->deleted_at }}</td>

                    {{-- actions --}}
                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-primary"> restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"> delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>No Category Founded</h1>
            @endforelse

        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
@endSection
