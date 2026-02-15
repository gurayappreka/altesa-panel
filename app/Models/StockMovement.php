<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'reference_type',
        'reference_id',
        'user_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($movement) {
            $product = $movement->product;
            
            if ($movement->type === 'in') {
                $product->stock_quantity += $movement->quantity;
            } else {
                $product->stock_quantity -= $movement->quantity;
            }
            
            $product->save();
        });
    }

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helpers
    public function getTypeLabel(): string
    {
        return $this->type === 'in' ? 'Giriş' : 'Çıkış';
    }

    public function getTypeColor(): string
    {
        return $this->type === 'in' ? 'green' : 'red';
    }
}
