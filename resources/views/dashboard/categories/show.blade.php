@props(['category', 'products'])

@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories">
        <a href="{{ route('dashboard.categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item categories">{{ $category->name  }}</li>
@endsection

@section('content')
    <h1>Category Products</h1>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Store</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Created At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" height="30" width="30"></td>
                <td>{{ $product->id }}</td>
                <td>
                    <a href="{{ route('dashboard.products.show', $product->id) }}">
                        {{ $product->name }}
                    </a>
                </td>
                <td>{{ $product->store->name }}</td>
                <td class="{{ $product->status === 'active' ? 'text-success' : 'text-danger' }}">
                    {{ ucfirst($product->status) }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->rating }}</td>
                <td>{{ $product->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('dashboard.categories.edit', $product->id) }}"
                       class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('dashboard.categories.destroy', $product->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Move To Trash</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="font-weight-bold">
                    No Products in This Category!
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $products->withQueryString()->links() }}
@endsection
