<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
        $products = Product::all();
        
        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.product.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['is_active'] = empty($data['is_active']) ? false : true;
        $product = Product::create($data);
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $fileName = $product->id . '_' . $index . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $fileName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $fileName
                ]);
            }
        }
        return redirect()->back()->with('message', 'tạo thành công');
    }

    public function delete($id) {
        $images = ProductImage::where('product_id', $id)->get();
        foreach ($images as $image) {
            $filePath = public_path('uploads/' . $image->name);
            if (file_exists($filePath)) {
                unlink($filePath);
                $image->delete();
            }
        }
        Product::destroy($id);
        return redirect()->back()->with('message', 'xóa thành công');
    }

    public function edit($id) {
        $product = Product::with('images')->with('category')->findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit')->with([
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update($id, Request $request) {
        $product = Product::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = empty($data['is_active']) ? false : true;

        if($request->hasFile('images')) {
            foreach ($product->images as $image) {
                $filePath = public_path('uploads/' . $image->name);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                ProductImage::destroy($image->id);
            }
            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $fileName = $product->id . '_' . $index . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $fileName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $fileName
                ]);
            }
        }
        $product->update($data);
        return redirect(route('admin.product'))->with([
            'message' => 'cập nhật thành công'
        ]);
    }
}
