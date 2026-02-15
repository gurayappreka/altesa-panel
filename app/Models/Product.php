<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'description', 'category_id', 'type', 'unit_id',
        'unit_price', 'currency', 'min_stock', 'max_stock', 'reorder_point',
        'barcode', 'is_purchasable', 'is_sellable', 'is_manufactured',
        'track_serial', 'track_lot', 'lead_time_days', 'lifecycle', 'is_active', 'notes'
    ];

    protected $casts = [
        'unit_price' => 'decimal:4',
        'min_stock' => 'decimal:4',
        'max_stock' => 'decimal:4',
        'reorder_point' => 'decimal:4',
        'is_purchasable' => 'boolean',
        'is_sellable' => 'boolean',
        'is_manufactured' => 'boolean',
        'track_serial' => 'boolean',
        'track_lot' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function boms(): HasMany
    {
        return $this->hasMany(Bom::class);
    }

    public function activeBom(): BelongsTo
    {
        return $this->belongsTo(Bom::class)->where('status', 'active')->latest();
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function getTotalStockAttribute(): float
    {
        return $this->stocks()->sum('quantity');
    }

    public function getAvailableStockAttribute(): float
    {
        return $this->stocks()->sum('available_qty');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeManufactured($query)
    {
        return $query->where('is_manufactured', true);
    }

    public function scopePurchasable($query)
    {
        return $query->where('is_purchasable', true);
    }
}
