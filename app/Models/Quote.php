<?php

namespace App\Models;

use App\Traits\GeneratesNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory, GeneratesNumber;

    protected $fillable = [
        'quote_no',
        'customer_id',
        'user_id',
        'status',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total',
        'valid_until',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'tax_rate' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total' => 'decimal:2',
            'valid_until' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            if (empty($quote->quote_no)) {
                $quote->quote_no = self::generateNumber('TKL', 5, 'quotes', 'quote_no');
            }
        });
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class)->orderBy('sort_order');
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
    public function calculateTotals()
    {
        $this->subtotal = $this->items->sum('total');
        $this->tax_amount = $this->subtotal * ($this->tax_rate / 100);
        $this->total = $this->subtotal + $this->tax_amount;
        $this->save();
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'gray',
            'sent' => 'blue',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'draft' => 'Taslak',
            'sent' => 'Gönderildi',
            'approved' => 'Onaylandı',
            'rejected' => 'Reddedildi',
            default => $this->status,
        };
    }
}
