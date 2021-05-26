<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function createCategory(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'name' => 'required|unique:category'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $files = null;
        if ($request->hasFile("icon")) {
            $files = Storage::disk("upload_public")->put("images/product", $request->file("icon"));
        } else {
            $files = $request->icon;
        }
        $create = Category::create([
            'name' => $request->name,
            'icon' => $files,
            'user_id' => $auth->id
        ]);
        $create->save();
        return response()->json(['message' => "Category telah dibuat", 'results' => new CategoryResource($create)], 201);
    }
    public function updateCategory(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $find = Category::find($id);
        if (!$find) {
            return response()->json(['message' => 'Category tidak ditemukan'], 404);
        }
        $find->name = $request->name;
        $files = null;
        if ($request->hasFile("icon")) {
            $files = Storage::disk("upload_public")->put("images/product", $request->file("icon"));
        } else {
            $files = $request->icon;
        }
        if ($files) {
            $find->icon = $files;
        }
        $find->save();
        return response()->json(['message' => "Category telah diperbarui", 'results' => new CategoryResource($find)], 200);
    }
    public function destroyCategory(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $find = Category::find($id);
        if (!$find) {
            return response()->json(['message' => "Category tidak ditemukan"], 404);
        }
        $find->delete();
        return response()->json(['message' => "Category telah dihapus"], 200);
    }
    public function listCategory(Request $request)
    {
        return response()->json(CategoryResource::collection(Category::all()), 200);
    }
    public function createProduct(Request $request)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $val = Validator::make($request->all(), [
            'name' => 'required|unique:product|min:2',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $files = null;
        if ($request->hasFile("image")) {
            $files = Storage::disk("upload_public")->put("images/product", $request->file("image"));
        } else {
            $files = $request->image;
        }
        $create = Product::create([
            'name' => $request->name,
            'image' => $files,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'user_id' => $auth->id,
        ]);
        $create->save();
        return response()->json(['message' => 'Product telah dibuat', 'results' => new ProductResource($create)], 201);
    }
    public function updateProduct(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $find = Product::find($id);
        if (!$find) {
            return response()->json(['message' => "Product tidak ditemukan"], 404);
        }
        $val = Validator::make($request->all(), [
            'name' => 'required|unique:product|min:2',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 400);
        }
        $files = null;
        if ($request->hasFile("image")) {
            $files = Storage::disk("upload_public")->put("images/product", $request->file("image"));
        } else {
            $files = $request->image;
        }
        $find->name = $request->name;
        if ($files) {
            $find->image = $files;
        }
        $find->price = $request->price;
        $find->stock = $request->stock;
        $find->description = $request->description;
        $find->sold = $request->sold;
        $find->category_id = $request->category_id;
        $find->save();
        return response()->json(['message' => 'Product telah diperbarui', 'results' => new ProductResource($find)], 200);
    }
    public function destroyProduct(Request $request, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(false, 401);
        }
        $find = Product::find($id);
        if (!$find) {
            return response()->json(['message' => 'Product tidak ditemukan'], 404);
        }
        $find->delete();
        return response()->json(['message' => 'Product telah dihapus'], 200);
    }
    public function listProduct(Request $request)
    {
        return response()->json(ProductResource::collection(Product::all()), 200);
    }
}
