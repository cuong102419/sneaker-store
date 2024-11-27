<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::when($search, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('id', 'like', '%' . $search . '%');
        })->latest('id')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function uploadFile(Request $request, $filename) {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('brands');
        }

        return null;
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:1', 'unique:categories'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $data['image'] = $this->uploadFile($request, 'image');
        Category::query()->create($data);
        return redirect()->route('categories.index')->with('success', 'Tạo mới thành công.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'min:1', 'unique:categories'],
            'image' => ['required', 'image'],
        ]);

        if($category->image) {
            Storage::delete($category->image);
        }

        $data['image'] = $this->uploadFile($request, 'image');

        $category->update($data);
        return redirect()->back()->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->back()->with('success', 'Xóa thành công.');
    }
}
