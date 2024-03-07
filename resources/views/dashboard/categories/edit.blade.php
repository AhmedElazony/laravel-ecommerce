@props(['category'])

@extends('layouts.dashboard')

@section('title', 'Edit Category: ' . $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item categories">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.categories._form')
    </form>

@endsection
