<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index() {
        $sizes = Size::all();
        return view('admin.product.size.index', compact('sizes'));
    }

    public function create() {
        return view('admin.product.size.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'size' => ['required', 'unique:sizes'],
        ]);

        Size::query()->create($data);
        return redirect()->route('size.index')->with('success', 'Tạo kích cỡ thành công.');
    }

}
