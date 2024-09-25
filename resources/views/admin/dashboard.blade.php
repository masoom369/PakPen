@extends('layouts.admin')
@Section('content')

<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>User List</h4>
    </center>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('destroy'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('destroy') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="table-responsive">
        <table class="table" id="user">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                     <th>Actual User Type</th>
                    <th>Reguested User Type</th>
                    <th>Verifiaction Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->actual_usertype }}</td>
                        <td>{{ $user->requested_usertype }}</td>
                        <td>{{ $user->verification_status }}</td>
                        <td>
                            <a href="{{ url('admin/user-approve', $user->id) }}" class="btn btn-warning">Edit</a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No User Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>seller List</h4>
    </center>
    <div class="table-responsive">
        <table class="table" id="seller">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                     <th>Actual User Type</th>
                    <th>Reguested User Type</th>
                    <th>Verifiaction Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sellers as $seller)
                    <tr>
                        <td>{{ $seller->id }}</td>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>{{ $seller->phone }}</td>
                        <td>{{ $seller->address }}</td>
                        <td>{{ $seller->actual_usertype }}</td>
                        <td>{{ $seller->requested_usertype }}</td>
                        <td>{{ $seller->verification_status }}</td>
                        <td>
                            <a href="{{ url('admin/user-approve', $seller->id) }}" class="btn btn-warning">Edit</a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No User Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>delivery agent List</h4>
    </center>
    <div class="table-responsive">
        <table class="table" id="delivery_agent">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                     <th>Actual User Type</th>
                    <th>Reguested User Type</th>
                    <th>Verifiaction Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($delivery_agents as $delivery_agent)
                    <tr>
                        <td>{{ $delivery_agent->id }}</td>
                        <td>{{ $delivery_agent->name }}</td>
                        <td>{{ $delivery_agent->email }}</td>
                        <td>{{ $delivery_agent->phone }}</td>
                        <td>{{ $delivery_agent->address }}</td>
                        <td>{{ $delivery_agent->actual_usertype }}</td>
                        <td>{{ $delivery_agent->requested_usertype }}</td>
                        <td>{{ $delivery_agent->verification_status }}</td>
                        <td>
                            <a href="{{ url('admin/user-approve', $delivery_agent->id) }}" class="btn btn-warning">Edit</a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No User Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>customer List</h4>
    </center>
    <div class="table-responsive">
        <table class="table" id="customer">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                     <th>Actual User Type</th>
                    <th>Reguested User Type</th>
                    <th>Verifiaction Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->actual_usertype }}</td>
                        <td>{{ $customer->requested_usertype }}</td>
                        <td>{{ $customer->verification_status }}</td>
                        <td>
                            <a href="{{ url('admin/user-approve', $customer->id) }}" class="btn btn-warning">Edit</a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No User Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
