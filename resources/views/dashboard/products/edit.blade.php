@props(['product', 'categories', 'tags'])

@extends('layouts.dashboard')

@section('title', 'Edit Product: ' . $product->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item categories">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.products._form', [
            'buttonLabel' => 'Update',
        ])
    </form>

@endsection
