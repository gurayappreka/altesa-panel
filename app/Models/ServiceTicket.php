<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_no', 'company_id', 'contact_id', 'project_id', 'installation_id',
        'type', 'priority', 'status', 'subject', 'description', 'resolution',
        'assigned_to', 'responded_at', 'resolved_at', 'closed_at', 'created_by'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function installation(): BelongsTo
    {
        return $this->belongsTo(Installation::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ServiceTicketComment::class);
    }

    public function scopeOpen($query)
    {
        return $query->whereNotIn('status', ['closed', 'cancelled']);
    }

    public function scopeCritical($query)
    {
        return $query->where('priority', 'critical');
    }
}
