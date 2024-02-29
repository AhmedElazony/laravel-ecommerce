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

        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" />
        </div>

        <div class="form-group">
            <label for="parent-id">Parent Category</label>
            <select name="parent_id" id="" class="form-control form-select">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" name="parent_id">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class=" form-control">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="status" value="Active" checked>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="status" class="form-check-input" value="Archived">
                    <label class="form-check-label" for="status">Archived</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
