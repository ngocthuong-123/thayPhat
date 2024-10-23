<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product'; // Chỉ định tên bảng

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'thumbnail',
        'description',
        'content',
        'pricebuy',
        'pricesale',
        'qty',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status',
    ];

    public $timestamps = false; // Nếu không muốn sử dụng timestamps tự động
}