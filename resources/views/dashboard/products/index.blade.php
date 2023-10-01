@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">Products</a></li>
@endsection


@section('content')

    <div class="mb-3 d-flex justify-start ">
        {{-- <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mx-2 ">create</a>
        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-danger mx-2 ">trash</a> --}}
    </div>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>name</th>
                <th>store</th>
                <th>category</th>
                <th>price</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                            class="btn btn-sm btn-primary">edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"> delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr colspan="7">No Products Founded</tr>
            @endforelse

        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
    {{-- NOTE : we can append value to the query , and we can specify the pagination links style (just for this file) by ->link(style.path) --}}

@endSection
{{-- ! NOTE: in case that the function in controller looks like this: $products = Product::paginate() --}}
{{-- we can get the store , category data  by accessing the relation --}}
{{-- Recommended :   <td>{{ $product->store->name }}</td> --}}
{{-- <td>{{ $product->store()->first()->name }}</td> --}}

{{-- ! but we can use egear loading for enhancing the performance --}}
{{-- in controller Product::with('store', 'category')->paginate(20);  --}}
{{-- Recommended :   <td>{{ $product->store->name }}</td> --}}
