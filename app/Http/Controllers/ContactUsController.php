<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Create a new ContactUs entry
        ContactUs::create($request->only('name', 'email', 'message'));

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function index()
    {
        // Optionally check if the user is authorized to view messages
        // $this->authorize('viewAny', ContactUs::class);

        $messages = ContactUs::all();
        return view('admin.contact-messages', compact('messages'));
    }

    public function destroy($id)
    {
        $message = ContactUs::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}