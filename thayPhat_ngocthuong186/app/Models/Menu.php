<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'name',
        'link',
        'type',
        'table_id',
        'parent_id',
        'sort_order',
        'position',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status'
    ];
}
