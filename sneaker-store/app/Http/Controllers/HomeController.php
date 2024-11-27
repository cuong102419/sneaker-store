<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productsNew = Product::orderByDesc('id')->limit(8)->get();
        $productsView = Product::orderByDesc('view')->limit(8)->get();
        $productsSell = Product::orderByDesc('sales_count')->limit(8)->get();

        return view('client.index', compact('productsNew', 'productsView', 'productsSell'));
    }
}
