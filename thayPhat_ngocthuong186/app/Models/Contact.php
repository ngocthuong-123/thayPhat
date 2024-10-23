<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'content',
        'reply_id',
        'created_at',
        'updated_at',
        'updated_by',
        'status'
    ];
}
