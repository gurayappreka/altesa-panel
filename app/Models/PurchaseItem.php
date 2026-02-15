<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'description',
        'quantity',
        'unit',
        'unit_price',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'unit_price' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            if ($item->unit_price && $item->quantity) {
                $item->total = $item->quantity * $item->unit_price;
            }
        });

        static::saved(function ($item) {
            $item->purchase->calculateTotal();
        });

        static::deleted(function ($item) {
            $item->purchase->calculateTotal();
        });
    }

    // Relationships
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
