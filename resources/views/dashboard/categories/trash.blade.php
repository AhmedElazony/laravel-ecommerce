@props(['categories'])

@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item categories">Trash</li>
@endsection

@section('content')

    <div class="mb-3">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-primary btn-sm ml-2">
            Go Back
        </a>
    </div>

    <x-alert type="success" />
    <x-alert type="warning" />

    <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Search For Category by Name" class="mx-2" :value="request('name')"/>
        <select name="status" class="form-control">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button type="submit" class="btn btn-dark mx-2 w-25">Filter</button>
        <a href="{{route('dashboard.categories.index')}}" class="btn btn-primary w-25">Rest Filter</a>
    </form>

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
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.forceDelete', $category->id) }}" method="post">
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
    {{ $categories->withQueryString()->links() }}
@endsection
