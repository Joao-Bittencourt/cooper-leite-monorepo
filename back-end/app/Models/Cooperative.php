<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cooperative extends Model
{
    /** @use HasFactory<\Database\Factories\CooperativeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'active',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the transactions for the Cooperative
     *
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
