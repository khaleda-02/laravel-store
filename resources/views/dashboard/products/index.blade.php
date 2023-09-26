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

    {{-- <form action="{{ URL::current() }}" method="get" class="d-flex justify-center">
        <x-form.input name="name" :value="request('name')" placeholder="product name" class="form-control mx-2" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>active</option>
            <option value="archived" @selected(request('status') == 'archived')>archived</option>
        </select>
        <button class="btn btn-dark" class="form-control mx-2">search</button>
    </form> --}}

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
                    <td>{{ $product->store_id }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status }}</td>
                </tr>
            @empty
                <td colspan="7">NoCategory Founded</td>
            @endforelse

        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
    {{-- NOTE : we can append value to the query , and we can specify the pagination links style (just for this file) by ->link(style.path) --}}

@endSection
