@props(['products'])

@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories">Products</li>
@endsection

@section('content')

    <div class="mb-3">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-primary btn-sm">
            Add new Product
        </a>

        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-outline-primary btn-sm ml-2">
            Go To Trash
        </a>
    </div>

    <x-alert type="success" />
    <x-alert type="warning" />

    <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Search For Product by Name" class="mx-2" :value="request('name')"/>
        <select name="status" class="form-control">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'draft')>Draft</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button type="submit" class="btn btn-dark mx-2 w-25">Filter</button>
        <a href="{{route('dashboard.products.index')}}" class="btn btn-primary w-25">Rest Filter</a>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>price</th>
            <th>Rating</th>
            <th>Category</th>
            <th>Added At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" height="30" width="30"></td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td class="{{ $product->status === 'active' ? 'text-success' : 'text-danger' }}">
                    {{ ucfirst($product->status) }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->rating }}</td>
                <td>{{ $product->category_id }}</td>
                <td>{{ $product->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                       class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Move To Trash</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="font-weight-bold">
                    No Products Here!
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
@endsection
