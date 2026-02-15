<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'installation_no', 'project_id', 'sales_order_id', 'company_id',
        'site_name', 'site_address', 'site_city', 'site_country',
        'status', 'planned_start', 'planned_end', 'actual_start', 'actual_end',
        'lead_technician_id', 'site_contact_info', 'prerequisites', 'notes'
    ];

    protected $casts = [
        'planned_start' => 'date',
        'planned_end' => 'date',
        'actual_start' => 'datetime',
        'actual_end' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function leadTechnician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lead_technician_id');
    }

    public function crew(): HasMany
    {
        return $this->hasMany(InstallationCrew::class);
    }

    public function commissioningTasks(): HasMany
    {
        return $this->hasMany(CommissioningTask::class)->orderBy('order');
    }

    public function siteVisits(): HasMany
    {
        return $this->hasMany(SiteVisit::class);
    }

    public function getProgressAttribute(): int
    {
        $total = $this->commissioningTasks()->count();
        if ($total === 0) return 0;
        $completed = $this->commissioningTasks()->where('status', 'passed')->count();
        return round(($completed / $total) * 100);
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['completed', 'cancelled']);
    }
}
