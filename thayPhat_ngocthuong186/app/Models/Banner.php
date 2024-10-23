<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';
    protected $fillable = [
        'name',
        'link',
        'position',
        'image',
        'description',
        'sort_order',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status'
    ];
}
