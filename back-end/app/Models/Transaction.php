<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cooperative_id',
        'amount',
        'type',
        'created_by',
        'active',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the product that owns the transaction.
     *
     * @return BelongsTo<Product, $this>
     *
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the cooperative that owns the transaction.
     *
     * @return BelongsTo<Cooperative, $this>
     *
     */
    public function cooperative(): BelongsTo
    {
        return $this->belongsTo(Cooperative::class);
    }

    /**
     * Get the user that owns the transaction.
     *
     * @return BelongsTo<User, $this>
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
