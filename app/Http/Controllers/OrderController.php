<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        // Get the submitted quantities for each cart item
        $quantities = $request->input('quantities', []);

        // Get all cart items for the user
        $cartItems = CartItem::where('customer_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Start a transaction to ensure data integrity
        DB::transaction(function () use ($cartItems, $quantities, $user) {
            foreach ($cartItems as $item) {
                $quantity = isset($quantities[$item->cart_item_id]) ? (int)$quantities[$item->cart_item_id] : 1;
                $price = $item->product->p_price ?? $item->book->b_price;
                $totalPrice = $price * $quantity;

                // Create the order
                Order::create([
                    'seller_id' => $item->seller_id,
                    'customer_id' => $user->id,
                    'product_id' => $item->product_id, // can be null
                    'book_id' => $item->book_id,       // can be null
                    'order_price' => $totalPrice,      // Set total price
                    'order_quantity' => $quantity,     // Set quantity
                    'order_status' => 'processing',    // Default status
                ]);

                // Optionally remove the cart item after placing the order
                $item->delete();
            }
        });

        return redirect()->route('order.success')->with('message', 'Order placed successfully!');
    }
    public function userOrders()
    {
        $user = Auth::user();

        // Fetch orders where customer_id matches the authenticated user's ID
        $orders = Order::with(['product', 'book', 'seller']) // Fetch related data
            ->where('customer_id', $user->id)
            ->get();

        return view('orders.user', compact('orders'));
    }
    public function sellerOrders()
    {
        $user = Auth::user();

        // Fetch orders where seller_id matches the authenticated user's ID and status is processing
        $orders = Order::with(['product', 'book', 'customer'])
            ->where('seller_id', $user->id)
            ->where('order_status', 'processing')
            ->get();

        return view('orders.seller', compact('orders'));
    }
    public function readyOrders()
    {
        // Fetch orders where status is 'ready'
        $orders = Order::with(['product', 'book', 'customer', 'seller'])
            ->where('order_status', 'ready')
            ->get();

        return view('orders.delivery.ready', compact('orders'));
    }
    public function deliveringOrders()
    {
        // Fetch orders where status is 'delivering'
        $orders = Order::with(['product', 'book', 'customer', 'seller'])
            ->where('order_status', 'delivering')
            ->get();

        return view('orders.delivery.delivering', compact('orders'));
    }
    public function updateStatus($id)
{
    // Fetch the order by ID
    $order = Order::findOrFail($id);

    // Update the status to 'ready'
    $order->order_status = 'ready';
    $order->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order status updated to Ready.');
}
public function updateToDelivering($id)
{
    // Fetch the order by ID
    $order = Order::findOrFail($id);

    // Update the status to 'delivering'
    $order->order_status = 'delivering';
    $order->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order status updated to Delivering.');
}
public function updateToDelivered($id)
{
    // Fetch the order by ID
    $order = Order::findOrFail($id);

    // Update the status to 'delivered'
    $order->order_status = 'delivered';
    $order->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order status updated to Delivered.');
}

}
