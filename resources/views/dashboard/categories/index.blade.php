@extends('layouts.dashboard')

@section('title', 'Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">categories</a></li>
@endsection


@section('content')

    <div class="mb-3 d-flex justify-start ">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mx-2 ">create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-danger mx-2 ">trash</a>
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
                <th>parent</th>
                <th>products </th>
                <th>status</th>
                <th>created at </th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a> </td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->products_num }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>

                    {{-- actions --}}
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-primary">edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            {{-- ! NOTE : Method Spoofing  --}}
                            {{-- <input type="submit" name="_methond" value="delete" /> --}}
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"> delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>NoCategory Founded</tr>
            @endforelse

        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
    {{-- NOTE : we can append value to the query , and we can specify the pagination links style (just for this file) by ->link(style.path) --}}

@endSection
