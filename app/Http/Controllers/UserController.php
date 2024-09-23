<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-approve', compact('user'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'verification_status' => 'required|in:pending,approved,rejected',
            'actual_usertype' => 'required|string|in:admin,seller,customer,delivery_agent,banned',
        ]);

        $user = User::findOrFail($id);
        $user->verification_status = $request->input('verification_status');
        $user->actual_usertype = $request->input('actual_usertype');
        $user->save();

        return redirect()->route('home')->with('success', 'User approved successfully.');
    }
}
