<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'seller_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.product_id' => 'nullable|exists:products,product_id',
            'items.*.book_id' => 'nullable|exists:books,book_id',
        ]);

        foreach ($validated['items'] as $item) {
            $order = new Order();
            $order->seller_id = $validated['seller_id'];
            $order->customer_id = $validated['customer_id'];
            $order->product_id = $item['product_id'] ?? null;
            $order->book_id = $item['book_id'] ?? null;
            $order->order_quantity = $item['quantity'];
            $order->order_price = ($order->product ? $order->product->p_price : $order->book->b_price) * $item['quantity'];
            $order->order_status = 'processing';
            $order->save();
        }

        // You can redirect or show success message here
        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }
}
