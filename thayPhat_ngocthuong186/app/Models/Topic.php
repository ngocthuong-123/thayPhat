<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topic'; // Chỉ định tên bảng

    protected $fillable = [
        'name',
        'slug',
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
