<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // Hiển thị danh sách banner
    public function index()
    {
        $banners = Banner::all();
        return response()->json($banners);
    }

    // Tạo banner mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|url',
            'position' => 'required|string|max:255',
            'image' => 'required|string|max:255', // Giả sử bạn lưu đường dẫn ảnh
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|integer'
        ]);

        $banner = Banner::create($request->all());
        return response()->json($banner, 201);
    }

    // Hiển thị một banner theo ID
    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json($banner);
    }

    // Cập nhật thông tin banner
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'link' => 'nullable|url',
            'position' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer'
        ]);

        $banner = Banner::findOrFail($id);
        $banner->update($request->all());
        return response()->json($banner);
    }

    // Xóa một banner
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return response()->json(null, 204);
    }
}