@extends('layouts.customer')

@section('content')
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>Your Orders</h4>
    </center>
    <div class="table-responsive">
        <table class="table" id="mytable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product/Book</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->product->p_name ?? $order->book->b_name }}</td>
                    <td>${{ number_format($order->order_price, 2) }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>{{ ucfirst($order->order_status) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No orders to display.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
