<div class="form-group">
    <x-form.input type="text" name="name" label="Category Name" :old-value="$category->name ?? null" />
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

{{--    <x-form.select name="parent_id" :items="$parents" label="Parent Category" :old-value="$category->parent_id" /> --}}
</div>

<div class="form-group">
    <x-form.textarea name="description" label="Description" :old-value="$category->description ?? null" />
</div>

<div class="form-group">
    <x-form.input type="file" name="image" label="Image" :old-value="$category->image ?? old('image')" />
    @if ($category->image ?? false)
        <img src="{{ asset('storage/' . $category->image) }}" height="200"  alt=""/>
    @endif
</div>

<div class="form-group">
    <div>
        <x-form.input-radio name="status" label="Status" :old-value="$category->status ?? null" :options="['active', 'archived']" />
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $buttonLabel ?? 'Save' }}</button>
</div>
