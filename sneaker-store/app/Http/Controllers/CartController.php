<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $variantId = $request->variant_id;
        $quantity = $request->quantity ?? 1;
        $productId = ProductVariant::where('id', $variantId)->first()->product_id;
        $image = Product::where('id', $productId)->first()->image;
        $name = Product::where('id', $productId)->first()->name;
        $unitPrice = Product::where('id', $productId)->first()->price;
        $subtotal = $quantity * $unitPrice;
        $sizeId = ProductVariant::where('id', $variantId)->first()->size_id;
        $size = Size::where('id', $sizeId)->first()->size;

        $productIndex = null;
        foreach ($cart as $index => $item) {
            if ($item['variant_id'] == $variantId) {
                $productIndex = $index;
                break;
            }
        }

        if ($productIndex !== null) {
            $cart[$productIndex]['quantity'] += $quantity;
            $cart[$productIndex]['subtotal'] = $cart[$productIndex]['quantity'] * $unitPrice;
        } else {
            $cart[] = [
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'product_id' => $productId,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                'image' => $image,
                'name' => $name,
                'size' => $size,
            ];
        }

        session()->put('cart', $cart);
        if ($request->input('action') === 'addToCart') {
            return redirect()->back()->with('message', 'Thêm vào giỏ hàng thành công.');
        } else if ($request->input('action') === 'buyNow') {
            return redirect()->route('pay');
        }
    }

    public function removeFromCart($variantId)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['variant_id'] == $variantId) {
                unset($cart[$index]);
                break;
            }
        }

        session()->put('cart', array_values($cart));
        return redirect()->back();
    }

    public function updateCart(Request $request, $variantId)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $index => $item) {
            if ($item['variant_id'] == $variantId) {
                $cart[$index]['quantity'] = $request->input('quantity');
                $cart[$index]['subtotal'] = $cart[$index]['quantity'] * $cart[$index]['unit_price'];
            }
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }
}
