<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        // Session::put('cart', []);

        // $categories = Category::Where('is_active', 1)->get();
        $categories = Category::with('products')
        ->get();
        $products = Product::with('images')->join('categories', 'categories.id', '=', 'products.category_id')->select('products.*', 'categories.name as category_name')
        ->where('products.is_active', 1)
        ->where('categories.is_active', 1)
        ->get();

        return view('client.home.index')->with([
            'categories' => $categories,
            'products' =>  $products
        ]);
    }

    public function category($id) {
        $category = Category::where('id', $id)
        ->where('is_active', 1)
        ->firstOrFail();

        $products = Product::where('category_id', $id)
        ->where('is_active', 1)
        ->paginate(9);

        return view('client.home.category')->with([
            'category' => $category,
            'products' => $products
        ]);
    }

    public function product($id) {
        $product = Product::where('id', $id)
        ->where('is_active', 1)->firstOrFail();
        $suggests = Product::where('is_active', 1)
        ->where('category_id', $product->category_id)
        ->where('id', '<>' ,$id)->get();
        return view('client.home.product')->with([
            'product' => $product,
            'suggests' => $suggests

        ]);
    }

    public function search(Request $request) {
        $keywords = explode(' ', $request->keyword);
        $products = Product::where('is_active', 1);
        
        foreach ($keywords as $keyword) {
            $products->where('name', 'like', '%' . $keyword . '%');
        }
        
        $products = $products->get();
        return view('client.search.index')->with([
            'products' => $products,
        ]);
    }
}
