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
    public function index()
    {
        $statusLabels = [
            'available' => ['label' => 'Còn hàng', 'class' => 'text-success'],
            'out_of_stock' => ['label' => 'Hết hàng', 'class' => 'text-danger'],
            'discontinued' => ['label' => 'Ngừng kinh doanh', 'class' => '']
        ];
        $products = Product::with('category')->latest('id')->paginate(8);
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

        $data = $request->validate([
            'name' => ['required', 'min:4', 'unique:products,name,' . $id],
            'category_id' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image'],
            'description' => ['required'],
            'sizes' => ['required', 'array'],
            'sizes.*' => ['exists:sizes,id'],
            'quantities' => ['required', 'array'],
            'quantities.*' => ['integer', 'min:1'],
            'ab_image' => ['nullable'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->uploadFile($request, 'image');
        } else {
            $data['image'] = $product->image;
        }

        $dataProduct = Arr::except($data, ['sizes', 'quantities', 'ab_image']);
        $product->update($dataProduct);

        ProductVariant::where('product_id', $product->id)->delete();

        $sizes = $data['sizes'];
        $quantities = $data['quantities'];

        foreach ($sizes as $key => $size) {
            ProductVariant::create([
                'product_id' => $product->id,
                'size_id' => $size,
                'quantity' => $quantities[$key],
            ]);
        }

        if (!empty($data['ab_image'])) {
            $album = $this->uploadAlbum($request, 'ab_image');

            $oldImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($oldImages as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }

            foreach ($album as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

}
