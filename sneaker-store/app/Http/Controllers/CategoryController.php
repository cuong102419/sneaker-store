<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $products = Product::where('category_id', $category->id)->latest('id')->paginate(10);
        return view('client.product.fill', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        })->orderByDesc('id')->paginate(10);
        return view('client.product.fill', compact('products'));
    }
}
