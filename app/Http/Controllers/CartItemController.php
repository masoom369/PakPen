<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function addToCart(Request $request)
    {
        // Check if the item is already in the cart
        $existingCartItem = CartItem::where('customer_id', $request->customer_id)
            ->where(function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
                if ($request->filled('book_id')) {
                    $query->orWhere('book_id', $request->book_id);
                }
            })
            ->first();

        if ($existingCartItem) {
            return redirect()->route('cart')->withErrors(['error' => 'This product or book is already in your cart.']);
        }

        // Create a new cart item
        CartItem::create([
            'product_id' => $request->filled(key: 'product_id') ? $request->product_id : null,
            'book_id' => $request->filled('book_id') ? $request->book_id : null,
            'seller_id' => $request->seller_id,
            'customer_id' => $request->customer_id,
        ]);

        return redirect()->route('cart')->with('success', 'Item added to cart successfully!');
    }

    public function removeCartItem($id)
    {
        $customerId = Auth::id();
        $cartItem = CartItem::where('cart_item_id', $id)
            ->where('customer_id', $customerId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart')->with('success', 'Item removed from cart.');
        }

        return redirect()->route('cart')->withErrors(['error' => 'Item not found in your cart.']);
    }

}
