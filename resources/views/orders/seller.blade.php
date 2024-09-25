@extends('layouts.seller')

@section('content')
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>Processing Orders</h4>
    </center>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('destroy'))
    <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
        {{ session('destroy') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="table-responsive">
        <table class="table" id="order">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product/Book</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->product->p_name ?? $order->book->b_name }}</td>
                    <td>${{ number_format($order->order_price, 2) }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>{{ ucfirst($order->order_status) }}</td>
                    <td>
                        <form action="{{ route('order.updateStatus', $order->order_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-primary">
                                Update to Ready
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No orders to process.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
