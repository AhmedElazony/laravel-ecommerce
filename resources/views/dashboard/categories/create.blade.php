@props(['categories'])

@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories">Categories</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="POST">
        @csrf

        @include('dashboard.categories._form')
    </form>

@endsection
