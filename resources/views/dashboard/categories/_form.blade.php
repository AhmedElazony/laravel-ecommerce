<div class="form-group">
    <x-form.input-label for="name">Category Name</x-form.input-label>
    <x-form.input type="text" name="name" :old-value="$category->name ?? null" />
    <x-form.input-error name="name" />
</div>

<div class="form-group">
    <x-form.input-label for="parent-id">Parent Category</x-form.input-label>
    <select name="parent_id" id="parent_id" @class([
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
    <x-form.input-error name="parent_id" />
</div>

<div class="form-group">
    <x-form.input-label for="description">Description</x-form.input-label>
    <x-form.textarea name="description" :old-value="$category->description ?? null" />
    <x-form.input-error name="description" />
</div>

<div class="form-group">
    <x-form.input-label for="image">Image</x-form.input-label>
    <x-form.input type="file" name="image" :old-value="$category->image ?? old('image')" />
    @if ($category->image ?? false)
        <img src="{{ asset('storage/' . $category->image) }}" height="200"  alt=""/>
    @endif
    <x-form.input-error name="image" />
</div>

<div class="form-group">
    <x-form.input-label for="status">Status</x-form.input-label>
    <div>
        <x-form.input-radio name="status" :old-value="$category->status ?? null" :options="['active', 'archived']" />
    </div>
    <x-form.input-error name="status" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $buttonLabel ?? 'Save' }}</button>
</div>
