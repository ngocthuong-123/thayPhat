<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all(); // Lấy tất cả thương hiệu
        return response()->json($brands);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:1000',
            'slug' => 'required|string|max:1000',
            'thumbnail' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'created_by' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Tạo thương hiệu mới
        $brand = Brand::create($request->all());
        return response()->json($brand, 201);
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id); // Tìm thương hiệu theo ID
        return response()->json($brand);
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'sometimes|required|string|max:1000',
            'slug' => 'sometimes|required|string|max:1000',
            'thumbnail' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'sort_order' => 'sometimes|required|integer',
            'updated_by' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        return response()->json($brand);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete(); // Xóa thương hiệu
        return response()->json(null, 204);
    }
}