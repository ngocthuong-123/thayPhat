<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand'; // Chỉ định tên bảng

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'description',
        'sort_order',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status',
    ];

    public $timestamps = false; // Nếu không muốn sử dụng timestamps tự động
}