<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashbroadController extends Controller
{
    public function dashbroad() {
        $totalOrder = Order::count();
        $totalUser = User::where('roll', 'user')->count();
        $totalComment = Comment::count();
        $bestSelling = Product::query()->orderByDesc('sales_count')->limit(10)->get();
        $bestViewing = Product::query()->orderByDesc('view')->limit(10)->get();
       
        return view('admin.dashbroad.index', compact('totalOrder', 'totalUser', 'totalComment', 'bestSelling', 'bestViewing'));
    }
}
