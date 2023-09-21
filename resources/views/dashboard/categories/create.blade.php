@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">categories</a></li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form', [
            'button_name' => 'Create',
        ])
    </form>
@endSection
