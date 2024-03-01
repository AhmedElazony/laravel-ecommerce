<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function store(Request $request)
    {
        // TODO: Validate Data

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        Category::create($request->all());

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
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id); // findOrFail returns 404 if $id is not found.

        $category->update($request->all());

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->back()->with('success', 'The Category ' . $category->name . ' Has Been Deleted!');
    }
}
