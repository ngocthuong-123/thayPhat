<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Hiển thị danh sách menu
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }

    // Tạo menu mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'link' => 'required|url|max:1000',
            'type' => 'required|string|max:100',
            'table_id' => 'nullable|integer',
            'parent_id' => 'required|integer',
            'sort_order' => 'required|integer',
            'position' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        $menu = Menu::create($request->all());
        return response()->json($menu, 201);
    }

    // Hiển thị một menu theo ID
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    // Cập nhật thông tin menu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:1000',
            'link' => 'sometimes|required|url|max:1000',
            'type' => 'sometimes|required|string|max:100',
            'table_id' => 'nullable|integer',
            'parent_id' => 'sometimes|required|integer',
            'sort_order' => 'sometimes|required|integer',
            'position' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|integer'
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());
        return response()->json($menu);
    }

    // Xóa một menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(null, 204);
    }
}