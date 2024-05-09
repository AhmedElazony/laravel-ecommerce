<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    use SoftDeletesActions;

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
        // TODO
    }

    public function store(Request $request, Product $product)
    {
        // TODO
    }

    public function show(Request $request, Product $product)
    {


    }

    public function edit(Request $request, Product $product)
    {
        // TODO
    }

    public function update(Request $request, Product $product)
    {
        // TODO
    }

    public function destroy(Request $request, Product $product)
    {
        // TODO
    }
}
