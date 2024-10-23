<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post'; // Chỉ định tên bảng

    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'type',
        'content',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status',
    ];

    public $timestamps = false; // Nếu không muốn sử dụng timestamps tự động
}
