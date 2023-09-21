@extends('layouts.dashboard')

@section('title', 'Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">categories</a></li>
@endsection


@section('content')

    <div class="mb-3">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">create</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>name</th>
                <th>parent</th>
                <th>created at </th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
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
                <h1>No Category Founded</h1>
            @endforelse

        </tbody>
    </table>
@endSection
