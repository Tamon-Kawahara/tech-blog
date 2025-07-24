<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // フォーム表示
    public function show()
    {
        return view('contact.show');
    }

    // フォーム送信・保存処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->route('contact.thanks');
    }
}
