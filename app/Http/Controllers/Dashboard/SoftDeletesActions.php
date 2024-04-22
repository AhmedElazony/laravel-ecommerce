<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait SoftDeletesActions
{
    public function trash()
    {
        return view("dashboard.{$this->modelObjects}.trash", [
            $this->modelObjects => $this->model::onlyTrashed()->paginate()
        ]);
    }

    public function restore(Request $request, string $id)
    {
        $object = $this->model::onlyTrashed()->findOrFail($id);
        $object->restore();

        return redirect()->route("dashboard.{$this->modelObjects}.trash")
            ->with('success', class_basename($this->model).' Has Been Restored!');
    }

    public function forceDelete(Request $request, string $id)
    {
        $object = Product::onlyTrashed()->findOrFail($id);
        $object->forceDelete();

        if ($object->image) {
            Storage::disk('public')->delete($object->image);
        }

        return redirect()->route("dashboard.{$this->modelObjects}.trash")
            ->with('warning', class_basename($this->model).' Has Been Restored!');
    }
}
