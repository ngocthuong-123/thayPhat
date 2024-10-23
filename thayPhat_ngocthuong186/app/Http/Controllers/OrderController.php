<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Lấy tất cả đơn hàng
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
        // $orders = Order::with('orderDetails')->get();
        // return response()->json($orders, 200);
    }

    // Tạo đơn hàng mới
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => $request->updated_by,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    // Lấy chi tiết đơn hàng
    public function show($id)
    {
        // Retrieve the order by its ID
        $order = Order::find($id);

        // Check if the order exists
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Return the order as a JSON response
        return response()->json($order);
    }

    // Cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
