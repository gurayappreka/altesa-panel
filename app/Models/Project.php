<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'description', 'company_id', 'contact_id', 'type',
        'status', 'priority', 'start_date', 'target_date', 'actual_end_date',
        'budget', 'actual_cost', 'currency', 'progress', 'manager_id', 'created_by', 'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'target_date' => 'date',
        'actual_end_date' => 'date',
        'budget' => 'decimal:2',
        'actual_cost' => 'decimal:2',
    ];

    // Relationships
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function phases(): HasMany
    {
        return $this->hasMany(ProjectPhase::class)->orderBy('order');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function timeEntries(): HasMany
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function installations(): HasMany
    {
        return $this->hasMany(Installation::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['completed', 'cancelled']);
    }

    // Accessors
    public function getBudgetUsedPercentAttribute(): float
    {
        if (!$this->budget || $this->budget == 0) return 0;
        return round(($this->actual_cost / $this->budget) * 100, 1);
    }

    public function getIsOverBudgetAttribute(): bool
    {
        return $this->budget && $this->actual_cost > $this->budget;
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->target_date && $this->target_date->isPast() && !in_array($this->status, ['completed', 'cancelled']);
    }
}
