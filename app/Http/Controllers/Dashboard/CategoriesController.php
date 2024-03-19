<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'parents' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // $data = $request->validate(Category::validationRules());
        $data = $request->validated();
        $data['slug'] = Str::slug($request->post('name'));

        $data['image'] = $this->uploadImage($request->file('image'));

        Category::create($data);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Has Been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('warning', 'Category Not Found!');
        }

        $parents = Category::filterParents($id)->get();

        return view('dashboard.categories.edit', [
            'category' => $category,
            'parents' => $parents
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        // $data = $request->validate(Category::validationRules($id));

        $category = Category::findOrFail($id); // findOrFail returns 404 if $id is not found.

        $data = $request->except('image');
        $oldImage = $category->image;
        $newImage = $this->uploadImage($request->file('image'));
        $data['image'] = $newImage ?? $oldImage;

        $category->update($data);

        if ($oldImage && $newImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->back()->with('success', 'The Category ' . $category->name . ' Has Been Deleted!');
    }

    protected function uploadImage($imageRequest)
    {
        if (!$imageRequest) {
            return null;
        }

        $imagePath = $imageRequest->store('images', [
            'disk' => 'public'
        ]);

        return $imagePath;
    }
}
