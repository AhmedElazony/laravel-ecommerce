@props(['products'])

@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item categories">Trash</li>
@endsection

@section('content')

    <div class="mb-3">
        <a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-primary btn-sm ml-2">
            Go Back
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
                    <form action="{{ route('dashboard.products.restore', $product->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('dashboard.products.forceDelete', $product->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete Permanently</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="font-weight-bold">
                    Trash is Empty!
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
@endsection
