<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị danh sách contact
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    // Tạo contact mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:100',
            'title' => 'required|string|max:1000',
            'content' => 'required|string',
            'reply_id' => 'nullable|integer',
            'status' => 'required|integer'
        ]);

        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    // Hiển thị một contact theo ID
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    // Cập nhật thông tin contact
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:100',
            'phone' => 'sometimes|required|string|max:100',
            'title' => 'sometimes|required|string|max:1000',
            'content' => 'sometimes|required|string',
            'reply_id' => 'sometimes|nullable|integer',
            'status' => 'sometimes|required|integer'
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact);
    }

    // Xóa một contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(null, 204);
    }
}