@props(['categories'])

@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories">Categories</li>
@endsection

@section('content')

    <div class="mb-3">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary btn-sm">
            Create Category
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-default-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="alert alert-default-warning">
            {{ session('warning') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Parent</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/' . $category->image) }}" height="30" width="30"></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="{{ $category->status === 'active' ? 'text-success' : 'text-danger' }}">
                        {{ ucfirst($category->status) }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="font-weight-bold">
                        No Categories Defined!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
