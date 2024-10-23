<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all(); // Lấy tất cả các chủ đề
        return response()->json($topics);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:1000',
            'slug' => 'required|string|max:1000',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'created_by' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Tạo chủ đề mới
        $topic = Topic::create($request->all());
        return response()->json($topic, 201);
    }

    public function show($id)
    {
        $topic = Topic::findOrFail($id); // Tìm chủ đề theo ID
        return response()->json($topic);
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'sometimes|required|string|max:1000',
            'slug' => 'sometimes|required|string|max:1000',
            'description' => 'nullable|string',
            'sort_order' => 'sometimes|required|integer',
            'updated_by' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
        ]);

        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        return response()->json($topic);
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete(); // Xóa chủ đề
        return response()->json(null, 204);
    }
}