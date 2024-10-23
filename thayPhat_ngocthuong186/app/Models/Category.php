<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; // Chỉ định tên bảng

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'description',
        'parent_id',
        'sort_order',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status',
    ];

    public $timestamps = false; // Nếu không muốn sử dụng timestamps tự động
}