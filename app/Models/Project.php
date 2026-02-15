<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customer_id',
        'status',
        'priority',
        'start_date',
        'end_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Helpers
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'planning' => 'blue',
            'active' => 'green',
            'on_hold' => 'yellow',
            'completed' => 'gray',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'planning' => 'Planlama',
            'active' => 'Aktif',
            'on_hold' => 'Beklemede',
            'completed' => 'Tamamlandı',
            'cancelled' => 'İptal',
            default => $this->status,
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'low' => 'gray',
            'medium' => 'yellow',
            'high' => 'red',
            default => 'gray',
        };
    }

    public function getProgressPercentage(): int
    {
        $totalTasks = $this->tasks()->count();
        if ($totalTasks === 0) return 0;

        $completedTasks = $this->tasks()->where('status', 'done')->count();
        return (int) (($completedTasks / $totalTasks) * 100);
    }
}
