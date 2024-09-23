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
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'seller_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
        ]);

        $existingCartItem = CartItem::where('customer_id', $request->customer_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            return response()->json([
                'message' => 'This product is already in your cart.',
            ], 409);
        }

        $cartItem = CartItem::create($validatedData);

        return response()->json([
            'message' => 'Item added to cart successfully!',
            'cart_item' => $cartItem,
        ], 201);
    }

    public function removeCartItem($id)
    {
        $customerId = Auth::id();
        $cartItem = CartItem::where('cart_item_id', $id)
            ->where('customer_id', $customerId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('shopping-cart')->with('success', 'Item removed from cart.');
        } else {
            return redirect()->route('shopping-cart')->withErrors(['error' => 'Item not found in your cart.']);
        }
    }

    public function placeOrder()
    {
        $customerId = Auth::id();
        $cartItems = CartItem::where('customer_id', $customerId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shopping-cart')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            foreach ($cartItems as $item) {
                Order::create([
                    'seller_id' => $item->seller_id,
                    'customer_id' => $item->customer_id,
                    'product_id' => $item->product_id,
                    'order_status' => 'processing',
                ]);
            }

            CartItem::where('customer_id', $customerId)->delete();

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('shopping-cart')->with('error', 'An error occurred while placing the order.');
        }
    }
}
