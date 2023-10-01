@extends('layouts.dashboard')

@section('title', 'Edite Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">products</a></li>
@endsection


@section('content')
    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" >
        @csrf
        @method('Put')
        @include('dashboard.products._form', [
            'button_name' => 'Update ',
        ])
    </form>
@endSection
