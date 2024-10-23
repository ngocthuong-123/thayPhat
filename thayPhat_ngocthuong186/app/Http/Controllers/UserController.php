<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:user',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'gender' => 'required|integer',
            'roles' => 'nullable|string|max:10',
            'created_by' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            ...$request->all(),
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Tìm người dùng theo ID
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:user,username,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'email' => 'sometimes|required|string|email|max:255|unique:user,email,' . $id,
            'phone' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:1000',
            'gender' => 'sometimes|required|integer',
            'roles' => 'nullable|string|max:10',
            'updated_by' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
        ]);

        $user = User::findOrFail($id);
        
        // Cập nhật người dùng
        $user->update([
            ...$request->except('password'), // Không cập nhật mật khẩu nếu không có
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Mã hóa mật khẩu
        ]);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Xóa người dùng
        return response()->json(null, 204);
    }
}