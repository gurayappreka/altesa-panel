<?php

namespace App\Models;

use App\Traits\GeneratesNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory, GeneratesNumber;

    protected $fillable = [
        'purchase_no',
        'supplier_id',
        'user_id',
        'status',
        'total',
        'expected_date',
        'delivered_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total' => 'decimal:2',
            'expected_date' => 'date',
            'delivered_date' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($purchase) {
            if (empty($purchase->purchase_no)) {
                $purchase->purchase_no = self::generateNumber('SIP', 5, 'purchases', 'purchase_no');
            }
        });
    }

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Helpers
    public function calculateTotal()
    {
        $this->total = $this->items->sum('total');
        $this->save();
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'ordered' => 'blue',
            'delivered' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Beklemede',
            'ordered' => 'Sipariş Verildi',
            'delivered' => 'Teslim Alındı',
            'cancelled' => 'İptal',
            default => $this->status,
        };
    }
}
