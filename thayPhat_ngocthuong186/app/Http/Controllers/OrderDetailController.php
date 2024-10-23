<?php

namespace App\Http\Controllers;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    // Lấy tất cả chi tiết đơn hàng
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return response()->json($orderDetails, 200);
    }

    // Tạo chi tiết đơn hàng mới
    public function store(Request $request)
    {
        $orderDetail = OrderDetail::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'qty' => $request->qty,
            'amout' => $request->amout,
        ]);

        return response()->json(['message' => 'OrderDetail created successfully', 'orderDetail' => $orderDetail], 201);
    }

    // Lấy chi tiết đơn hàng theo id
    public function show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return response()->json($orderDetail, 200);
    }

    // Cập nhật chi tiết đơn hàng
    public function update(Request $request, $id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($request->all());

        return response()->json(['message' => 'OrderDetail updated successfully', 'orderDetail' => $orderDetail], 200);
    }

    // Xóa chi tiết đơn hàng
    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return response()->json(['message' => 'OrderDetail deleted successfully'], 200);
    }
}
