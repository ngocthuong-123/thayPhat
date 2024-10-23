<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetail';

    protected $fillable = ['order_id', 'product_id', 'price', 'discount', 'qty', 'amout'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public $timestamps = false;
    // public function up()
    // {
    //     Schema::table('orderdetail', function (Blueprint $table) {
    //         $table->timestamps(); // Thêm created_at và updated_at
    //     });
    // }

    // public function down()
    // {
    //     Schema::table('orderdetail', function (Blueprint $table) {
    //         $table->dropTimestamps(); // Xóa created_at và updated_at nếu rollback
    //     });
    // }
}
