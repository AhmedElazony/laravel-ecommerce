<div class="form-group">
    <x-form.input type="text" name="name" label="Product Name" :old-value="$product->name ?? null" />
</div>

<div class="form-group">
    <x-form.input-label for="category_id">Category</x-form.input-label>
    <select name="category_id" id="category_id" @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('category_id'),
    ])>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" name="category_id" @selected($product->category ?? false)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <x-form.input-error name="category" />

{{--    <x-form.select name="category" :items="$categories" label="Category" :old-value="$product->category" />--}}
</div>

<div class="form-group">
    <x-form.textarea name="description" label="Description" :old-value="$product->description ?? null" />
</div>

<div class="form-group">
    <x-form.input type="file" name="image" label="Image" :old-value="$product->image ?? old('image')" />
    @if ($product->image ?? false)
        <img src="{{ asset('storage/' . $product->image) }}" height="200"  alt=""/>
    @endif
</div>

<div class="form-group">
    <x-form.input name="price" label="Price" :old-value="$product->price ?? null" />
</div>

<div class="form-group">
    <x-form.input name="tags" id="tags" label="Tags" :old-value="$tags ?? null"/>
</div>

<div class="form-group">
    <x-form.input-radio name="status" label="Status" :old-value="$product->status ?? null" :options="['active', 'draft', 'archived']" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $buttonLabel ?? 'Save' }}</button>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]')
        var tagify = new Tagify(inputElm);
    </script>
@endpush
