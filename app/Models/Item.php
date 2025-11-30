<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'description',
        'price',
        'quantity',
        'manufacturing_date',
        'expiry_date',
        'status',
        'category',
        'type',
        'is_featured',
        'is_available',
        'features',
        'image',
        'document',
        'color',
        'url',
        'notes',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_available' => 'boolean',
        'manufacturing_date' => 'date',
        'expiry_date' => 'datetime',
    ];
}
