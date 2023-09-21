@extends('layouts.dashboard')

@section('title', 'Edite Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">categories</a></li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('Put')
        @include('dashboard.categories._form', [
            'button_name' => 'Update ',
        ])
    </form>
@endSection
