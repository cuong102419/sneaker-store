<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product) {
        $productAbImage = ProductImage::query()->where('product_id',$product->id)->get();
        $productVariant = ProductVariant::query()->where('product_id', $product->id)->get();
        $comments = Comment::where('product_id', $product->id)->latest('id')->paginate(5);
        $product->increment('view');

        return view('client.product.show', compact('product', 'productAbImage', 'productVariant', 'comments'));
    }

}
