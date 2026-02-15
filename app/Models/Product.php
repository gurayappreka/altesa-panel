<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'sku', 'description', 'unit', 'stock_quantity',
        'min_stock_level', 'supplier_id', 'location', 'is_active'
    ];

    protected $casts = [
        'stock_quantity' => 'decimal:2',
        'min_stock_level' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
