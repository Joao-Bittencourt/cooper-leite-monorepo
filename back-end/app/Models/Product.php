<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'unit',
        'price',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
