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
        return view('dashboard.products.index', [
            'products' => Product::paginate()
        ]);
    }
}
