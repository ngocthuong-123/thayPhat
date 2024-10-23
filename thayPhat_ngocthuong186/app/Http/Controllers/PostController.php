<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function post_new($limit)
{
    try {
        // Fetch posts from the database
        $posts = Post::where([['status', '=', 1], ['type', '=', 'post']])
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();

        // Prepare success response
        $result = [
            'posts' => $posts,
            'status' => true,
            'message' => 'Dữ liệu tải thành công'
        ];

        // Return success response in JSON format
        return response()->json($result);
    } catch (Exception $e) {
        // Prepare error response
        $result = [
            'posts' => null,
            'status' => false,
            'message' => 'Khong tìm thấy dữ liệu'
        ];

        // Return error response in JSON format
        return response()->json($result);
    }
}


public function post_all($limit, $page = 1)
{
    // Calculate the offset based on the page number and limit
    $offset = ($page - 1) * $limit;

    try {
        // Define query arguments
        $args = [
            ['status', '=', 1],
            ['type', '=', 'post']
        ];

        // Fetch posts from the database
        $posts = Post::where($args)
            ->orderBy('created_at', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();

        // Prepare success response
        $result = [
            'posts' => $posts,
            'status' => true,
            'message' => 'Dữ liệu tải thành công'
        ];

        // Return success response in JSON format
        return response()->json($result);
    } catch (Exception $e) {
        // Prepare error response
        $result = [
            'posts' => null,
            'status' => false,
            'message' => 'Không tìm thấy dữ liệu'
        ];

        // Return error response in JSON format
        return response()->json($result);
    }
}
public function post_detail($slug, $limit)
{
    try {
        // Fetch the specific post based on slug
        $post = Post::where([
            ['status', '=', 1],
            ['slug', '=', $slug],
            ['type', '=', 'post']
        ])->first();

        // Check if the post was found
        if (!$post) {
            throw new Exception('Post not found');
        }

        // Define query arguments for related posts
        $args = [
            ['status', '=', 1],
            ['type', '=', 'post'],
            ['id', '!=', $post->id]
        ];

        // Fetch related posts from the database
        $posts = Post::where($args)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();

        // Prepare success response
        $result = [
            //'posts' => $posts,
            'post' => $post,
            'status' => true,
            'message' => 'Dữ liệu tải thành công'
        ];

        // Return success response in JSON format
        return response()->json($result);
    } catch (Exception $e) {
        // Prepare error response
        $result = [
            'post' => null,
            'status' => false,
            'message' => $e->getMessage()
        ];

        // Return error response in JSON format
        return response()->json($result);
    }
}
public function post_page($slug)
{
    try {
        // Fetch the post based on slug
        $post = Post::where([
            ['status', '=', 1],
            ['slug', '=', $slug],
            ['type', '=', 'post']
        ])->first();

        // Check if the post was found
        if (!$post) {
            throw new Exception('Post not found');
        }

        // Prepare success response
        $result = [
            'post' => $post,
            'status' => true,
            'message' => 'Dữ liệu tải thành công'
        ];

        // Return success response in JSON format
        return response()->json($result);
    } catch (Exception $e) {
        // Prepare error response
        $result = [
            'post' => null,
            'status' => false,
            'message' => $e->getMessage()
        ];

        // Return error response in JSON format
        return response()->json($result);
    }
}
public function post_topic($topic_id, $limit)
{
    try {
        // Define query arguments
        $args = [
            ['status', '=', 1],
            ['topic_id', '=', $topic_id],
            ['type', '=', 'post']
        ];

        // Fetch posts from the database
        $posts = Post::where($args)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();

        // Prepare success response
        $result = [
            'posts' => $posts,
            'status' => true,
            'message' => $posts->isEmpty() ? 'No posts found for this topic.' : 'Posts loaded successfully'
        ];

        // Return success response in JSON format
        return response()->json($result);
    } catch (Exception $e) {
        // Log the error for debugging
        Log::error('Error fetching posts by topic:', ['error' => $e->getMessage()]);

        // Prepare error response
        $result = [
            'posts' => [],
            'status' => false,
            'message' => 'Error fetching data'
        ];

        // Return error response in JSON format
        return response()->json($result, 500); // Return a 500 status code for server errors
    }
}
public function index()
    {
        $posts = Post::all(); // Lấy tất cả bài viết
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'topic_id' => 'nullable|integer',
            'title' => 'required|string|max:1000',
            'slug' => 'required|string|max:1000',
            'thumbnail' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'type' => 'required|string|max:10',
            'content' => 'required|string',
            'created_by' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Tạo bài viết mới
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id); // Tìm bài viết theo ID
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'topic_id' => 'nullable|integer',
            'title' => 'sometimes|required|string|max:1000',
            'slug' => 'sometimes|required|string|max:1000',
            'thumbnail' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'type' => 'sometimes|required|string|max:10',
            'content' => 'sometimes|required|string',
            'updated_by' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete(); // Xóa bài viết
        return response()->json(null, 204);
    }
}
