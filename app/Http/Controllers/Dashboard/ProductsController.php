<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    use SoftDeletesActions, UploadImage;

    protected string $model = Product::class;
    protected string $modelObjects = "products";

    public function index()
    {
        // Eager Loading.
        $products = Product::with(['category', 'store'])->paginate();
        // this will make these queries, and will solve N + 1 problem.
        // 1. SELECT * FROM products
        // 2. SELECT * FROM categories WHERE id IN ([category_ids returned from the first query])
        // 3. SELECT * FROM stores WHERE id IN ([store_ids returned from the first query])

        return view('dashboard.products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(ProductRequest $request, Product $product)
    {
        $data = $request->except('tags');

        $data['slug'] = Str::slug($data['name']);

        $data['store_id'] = auth()->user()->store_id;

        $data['image'] = $this->uploadImage($request->file('image'));

        $product = Product::create($data);

        $this->HandleTags($request, $product);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product created successfully');
    }

    public function show(Request $request, Product $product)
    {
        return view('dashboard.products.show', [
            'product' => $product,
        ]);
    }

    public function edit(Request $request, Product $product)
    {
        $tags = implode(',', $product->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'tags' => $tags
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->except(['tags', 'image']);

        $this->HandleTags($request, $product);

        $oldImage = $product->image;
        $newImage = $this->uploadImage($request->file('image'));
        $data['image'] = $newImage ?? $oldImage;

        $product->update($data);

        if ($oldImage && $newImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->back()
            ->with('warning', "The Category '{$product->name}' Has Been Moved To Trash!");
    }

    public function HandleTags(ProductRequest $request, Product $product): void
    {
        $tags = json_decode($request->post('tags'));
        $tag_ids = [];

        $savedTags = Tag::all();

        foreach ($tags as $tag) {
            $slug = Str::slug($tag->value);
            $savedTag = $savedTags->where('slug', $slug)->first();

            if (!$savedTag) {
                $savedTag = Tag::create([
                    'name' => $tag->value,
                    'slug' => $slug
                ]);
            }

            $tag_ids[] = $savedTag->id;
        }

        $product->tags()->sync($tag_ids);
    }
}
