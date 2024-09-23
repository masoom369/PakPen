@extends('layouts.admin')
@section('content')

<div class="bg-light mt-5 mb-5" style="padding: 20px;">
    <center>
        <h4>Contact Messages</h4>
    </center>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table_responsive">
        <table class="table" id="messages">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Messages Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
