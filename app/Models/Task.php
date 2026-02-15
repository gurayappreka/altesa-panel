<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'assigned_to',
        'due_date',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
            ->whereNotIn('status', ['done']);
    }

    // Helpers
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'todo' => 'gray',
            'in_progress' => 'blue',
            'done' => 'green',
            default => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'todo' => 'Yapılacak',
            'in_progress' => 'Devam Ediyor',
            'done' => 'Tamamlandı',
            default => $this->status,
        };
    }

    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date < now() && $this->status !== 'done';
    }
}
