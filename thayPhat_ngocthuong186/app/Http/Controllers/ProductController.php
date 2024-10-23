<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception; // Corrected import for Exception

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        // return response()->json($products);
        $products = Product::where('status', 1)->get(); 
        return view('product.index')->with('products', $products);
    }

    public function product_all($limit, $page = 1)
    {
        $offset = ($page - 1) * $limit;

        try {
            $products = Product::where('status', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->offset($offset)
                ->limit($limit)
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

    public function product_detail($slug, $limit)
    {
        try {
            $product = Product::where([['status', '=', 1], ['slug', '=', $slug]])->first();

            $products = Product::where([['status', '=', 1], ['id', '!=', $product->id]])
                ->orderBy('created_at', 'DESC')
                ->limit($limit)
                ->get();

            $result = [
                'products' => $products,
                'product' => $product,
                'status' => true,
                'message' => 'Dữ liệu tải thành công'
            ];

            return response()->json($result);
        } catch (Exception $e) {
            $result = [
                'products' => null,
                'product' => null,
                'status' => false,
                'message' => 'Không tìm thấy dữ liệu'
            ];

            return response()->json($result);
        }
    }

    public function latest()
    {
        $latestProducts = Product::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return response()->json($latestProducts);
    }

    public function topSaleProducts()
    {
        $topSaleProducts = Product::orderBy('pricesale', 'desc')
            ->limit(3)
            ->get();

        return response()->json($topSaleProducts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'id' => 'required|integer',
        'category_id' => 'required|integer',
        'brand_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'description' => 'required|string',
        'content' => 'required|string',
        'pricebuy' => 'required|numeric',
        'pricesale' => 'required|numeric',
        'qty' => 'required|integer',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'created_by' => 'required|integer',
        'status' => 'required|integer|in:0,1,2'
    ]);

    try {
        // Handle the uploaded file
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dist/img/product'), $filename);
        } else {
            $filename = null; // Or handle case when no file is uploaded
        }

        // Create a new product instance
        $product = new Product();
        $product->id = $request->id;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->pricebuy = $request->pricebuy;
        $product->pricesale = $request->pricesale;
        $product->qty = $request->qty;
        $product->thumbnail = $filename;
        $product->created_by = $request->created_by;
        $product->status = $request->status;
        $product->save();

        // Redirect or return response
        return redirect()->route('product.index')->with('success', 'Product created successfully');
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
    $product = Product::findOrFail($id);

    // Return the view with the product
    return view('product.show', compact('product'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    // Fetch the product by its ID
    $product = Product::findOrFail($id);

    // Return the view with the product data
    return view('product.edit', compact('product'));
}
    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Validate the incoming request
    $request->validate([
        'category_id' => 'required|integer',
        'brand_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'description' => 'required|string',
        'content' => 'required|string',
        'pricebuy' => 'required|numeric',
        'pricesale' => 'required|numeric',
        'qty' => 'required|integer',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'created_by' => 'required|integer',
        'status' => 'required|integer|in:0,1,2'
    ]);

    try {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Handle the uploaded file
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('dist/img/product'), $filename);
            $product->thumbnail = $filename;
        }

        // Update product information
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->pricebuy = $request->pricebuy;
        $product->pricesale = $request->pricesale;
        $product->qty = $request->qty;
        $product->created_by = $request->created_by;
        $product->status = $request->status;
        $product->save();

        // Redirect or return response
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    } catch (\Exception $e) {
        // Handle exception
        return back()->withErrors(['error' => 'An error occurred while updating the product.']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
         $product = Product::findOrFail($id); // Tìm sản phẩm theo ID

        // Cập nhật trạng thái thành 0 (thùng rác)
        $product->status = 0;
        $product->save();

        return view('product.trash')->with('products', $product);
    
}
public function trash()
{
    // Retrieve all products with status 0 (soft deleted or trashed)
    $products = Product::where('status', 0)->get(); 

    // Return the view with the list of trashed products
    return view('product.trash')->with('products', $products);
}
public function toggleStatus($id)
{
    $product = Product::find($id);
    
    if ($product) {
        // Toggle status between 1 (active) and 0 (inactive)
        $product->status = $product->status == 1 ? 0 : 1;
        $product->updated_at = now(); // Cập nhật thời gian
        $product->updated_by = auth()->user()->id; // Giả sử người dùng đang đăng nhập là admin
        $product->save();
    }

    return redirect()->route('product.index')->with('success', 'Trạng thái sản phẩm đã được thay đổi');
}



}
