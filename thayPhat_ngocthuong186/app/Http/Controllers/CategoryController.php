<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        //  return response()->json($categories);
        return view('category.index')->with('categories', $categories);
    }
    public function cate_all()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function getProductsByCategory($categoryId)
    {
    try {
        // Lấy các sản phẩm với category_id tương tự
        $products = Product::where('category_id', $categoryId)
                            ->orderBy('created_at', 'DESC')
                            ->get();

        $result = [
            'products' => $products,
            'status' => true,
            'message' => 'Dữ liệu tải thành công'
        ];

        return response()->json($result);
    } catch (Exception $e) {
        $result = [
            'products' => null,
            'status' => false,
            'message' => 'Không tìm thấy dữ liệu'
        ];

        return response()->json($result);
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'parent_id' => 'required|integer',
            'sort_order' => 'required|integer',
            'created_by' => 'required|integer',
            'status' => 'required|integer|in:0,1,2'
        
        ]);
        try {
            // Handle the uploaded file
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('dist/img/category'), $filename);
            } else {
                $filename = null; // Or handle case when no file is uploaded
            }
            $product = new Category();
        $product->id = $request->id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->thumbnail = $filename;
        $product->parent_id = $request->parent_id;
        $product->sort_order = $request->sort_order;
        $product->created_by = $request->created_by;
        $product->status = $request->status;
        $product->save();

        // Redirect or return response
        return redirect()->route('category.index')->with('success', 'Product created successfully');
    } catch (\Exception $e) {
        // Handle exception
        return back()->withErrors(['error' => 'An error occurred while creating the product.']);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the product by its ID
        $category = Category::findOrFail($id);

        // Return the view with the product
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
