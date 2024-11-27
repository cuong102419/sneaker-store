<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $statusLabels = [
            'available' => ['label' => 'Còn hàng', 'class' => 'text-success'],
            'out_of_stock' => ['label' => 'Hết hàng', 'class' => 'text-danger'],
            'discontinued' => ['label' => 'Ngừng kinh doanh', 'class' => '']
        ];
        $products = Product::when($search, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('id', 'like', '%' . $search . '%');
        })->with('category')->latest('id')->paginate(8);
        return view('admin.product.index', compact('products', 'statusLabels'));
    }

    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('admin.product.create', compact('categories', 'sizes'));
    }

    public function uploadFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('images');
        }
        return null;
    }

    public function uploadAlbum(Request $request, $filename)
    {
        $uploadedFiles = [];

        if ($request->hasFile($filename)) {
            $files = is_array($request->file($filename)) ? $request->file($filename) : [$request->file($filename)];

            foreach ($files as $file) {
                $path = $file->store('album-images');
                $uploadedFiles[] = $path;
            }
        }

        return $uploadedFiles;
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:4', 'unique:products'],
            'category_id' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image'],
            'description' => ['required'],
            'sizes' => ['required'],
            'quantities' => ['required'],
            'ab_image' => ['nullable'],
        ]);
        $data['image'] = $this->uploadFile($request, 'image');

        $dataProduct = Arr::except($data, ['sizes', 'quantities', 'ab_image']);
        $product = Product::query()->create($dataProduct);

        $dataVariant = Arr::except($data, ['name', 'category_id', 'price', 'description', 'image']);
        $sizes = $dataVariant['sizes'];
        $quantities = $dataVariant['quantities'];

        foreach ($sizes as $key => $size) {
            ProductVariant::query()->create([
                'product_id' => $product->id,
                'size_id' => $size,
                'quantity' => $quantities[$key],
            ]);
        }

        if (!empty($data['ab_image'])) {
            $album = $data['ab_image'];
            $album = $this->uploadAlbum($request, 'ab_image');

            foreach ($album as $key => $image) {
                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Tạo sản phẩm thành công.');
    }

    public function show(Product $product)
    {
        $categories = Category::all();
        $sizes = Size::all();
        $productVariants = ProductVariant::where('product_id', $product->id)->get();
        $albumImage = ProductImage::where('product_id', $product->id)->get();
        return view('admin.product.edit', compact('categories', 'sizes', 'product', 'productVariants', 'albumImage'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $productVariants = ProductVariant::where('product_id', $id)->get();
        $productAlbums = ProductImage::where('product_id', $id)->get();

        $data = $request->validate([
            'name' => ['required', 'min:4', 'unique:products'],
            'category_id' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image'],
            'description' => ['required'],
            'sizes' => ['required', 'array'],
            'quantities' => ['required', 'array'],
            'ab_image' => ['nullable'],
        ]);


        $dataProduct = Arr::except($data, ['sizes', 'quantities', 'ab_image']);
        $dataVariant = Arr::only($data, ['sizes', 'quantities']);
        $sizes = $dataVariant['sizes'];
        $quantities = $dataVariant['quantities'];
        $albums = $data['ab_image'] ?? null;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $dataProduct['image'] = $this->uploadFile($request, 'image');
        }
        $product->update($dataProduct);

        foreach ($sizes as $key => $size_id) {
            foreach ($productVariants as $productVariant) {
                if ($productVariant->size_id == $size_id) {
                    $productVariant->quantity = $quantities[$key];
                    $productVariant->save();
                }
            }
        }

        if ($request->hasFile('ab_image')) {
            foreach ($productAlbums as $productAlbum) {
                if ($productAlbum->image) {
                    Storage::delete($productAlbum->image);
                    $productAlbum->delete();
                }
            }

            $albums = $this->uploadAlbum($request, 'ab_image');

            foreach ($albums as $image) {
                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy(Product $product) {
        $productVariants = ProductVariant::where('product_id', $product->id)->get();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        foreach ($productVariants as $productVariant) {
            $productVariant->delete();
        }

        foreach ($productImages as $productImage) {
            $productImage->delete();
        }

        $product->delete();

        return redirect()->back()->with('success','Xóa thành công.');
    }

}
