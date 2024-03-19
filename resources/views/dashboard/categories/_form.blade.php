<div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" name="name" @class(['form-control', 'is-invalid' => $errors->has('name')]) value="{{ $category->name ?? old('name') }}" />
    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="parent-id">Parent Category</label>
    <select name="parent_id" id="" @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('parent_id'),
    ])>
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" name="parent_id" @selected($category->parent_id ?? false) {{-- will select this option if the parent_id is set. --}}>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
    @error('parent_id')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description"
        @class(['form-control', 'is-invalid' => $errors->has('description')])>{{ $category->description ?? old('description') }}</textarea>
    @error('description')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" @class(['form-control', 'is-invalid' => $errors->has('image')]) value="{{ $category->image ?? old('image') }}">
    @if ($category->image ?? false)
        <img src="{{ asset('storage/' . $category->image) }}" height="200" />
    @endif
    @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status</label>
    <div>
        <div class="form-check">
            <input type="radio" @class(['form-check-input', 'is-invalid' => $errors->has('status')]) name="status" value="active"
                @checked($category->status ?? old('status') === 'active')>
            {{-- {{ $category->status === 'active' ? 'checked' : '' }} --}}
            <label class="form-check-label" for="status">Active</label>
        </div>
        <div class="form-check">
            <input type="radio" name="status" @class(['form-check-input', 'is-invalid' => $errors->has('status')]) value="archived"
                @checked($category->status ?? old('status') === 'archived')>
            <label class="form-check-label" for="status">Archived</label>
        </div>
    </div>
    @error('status')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $buttonLabel ?? 'Save' }}</button>
</div>
