@extends('layouts.admin')
@section('content')
<div class="md:grid md:grid-cols-3 md:gap-6 mt-5 mb-5">
    <div class="md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            <h4 class="mb-2">Edit User</h4>
            <form method="POST" action="{{ url('admin/user-approve', $user->id) }}">
                @csrf
                @method('PUT')
                <!-- Use PUT method for update -->

                <div class="mb-2">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>

                <div class="mb-2">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" readonly>
                </div>

                <div class="mb-2">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ $user->address }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="requested_usertype" class="form-label">Requested User Type:</label>
                    <input type="text" id="requested_usertype" name="requested_usertype" class="form-control" value="{{ $user->requested_usertype }}" readonly>
                </div>

                <div class="mb-2">
                    <label for="actual_usertype" class="form-label">Actual User Type:</label>
                    <select id="actual_usertype" name="actual_usertype" class="form-select">
                        <option value="seller" @if($user->actual_usertype == 'seller') selected @endif>Seller</option>
                        <option value="customer" @if($user->actual_usertype == 'customer') selected @endif>Customer</option>
                        <option value="delivery_agent" @if($user->actual_usertype == 'delivery_agent') selected @endif>Delivery_agent</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="verification_status" class="form-label">Verifiaction Status:</label>
                    <select id="verification_status" name="verification_status" class="form-select">
                        <option value="pending" @if($user->verification_status == 'pending') selected @endif>Pending</option>
                        <option value="approved" @if($user->verification_status == 'approved') selected @endif>Approved</option>
                        <option value="rejected" @if($user->verification_status == 'rejected') selected @endif>Rejected</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
