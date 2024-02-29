@props(['category'])

@extends('layouts.dashboard')

@section('title', 'Edit Category: ' . $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item categories">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name ?? old('name') }}" />
        </div>

        <div class="form-group">
            <label for="parent-id">Parent Category</label>
            <select name="parent_id" id="" class="form-control form-select">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" name="parent_id" @selected($category->parent_id) {{-- will select this option if the parent_id is set. --}}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $category->description ?? old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class=" form-control" value="{{ $category->image ?? old('image') }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" value="Active"
                        {{ $category->status === 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="status" class="form-check-input" value="Archived"
                        {{ $category->status === 'archived' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Archived</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
