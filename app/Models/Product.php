<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'unit',
        'stock_quantity',
        'min_stock_level',
        'supplier_id',
        'location',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'stock_quantity' => 'decimal:2',
            'min_stock_level' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function quoteItems()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function bomItems()
    {
        return $this->hasMany(BomItem::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock_quantity', '<=', 'min_stock_level');
    }

    // Helpers
    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }
}
