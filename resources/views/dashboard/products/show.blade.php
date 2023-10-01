@extends('layouts.dashboard')

@section('title', 'Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">products</a></li>
@endsection


@section('content')

    <div class="mb-3 d-flex justify-start ">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mx-2 ">create</a>
    </div>
    <h1 class="">{{ $category->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>name</th>
                <th>store</th>
                <th>description </th>
                <th>status</th>
                <th>created at </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->description | '-' }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            @empty
                <h1>NoProduct Founded</h1>
            @endforelse

        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}

@endSection
