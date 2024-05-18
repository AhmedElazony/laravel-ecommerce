@props(['categories', 'tags'])

@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories">Products</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('dashboard.products._form', $categories)
    </form>

@endsection
