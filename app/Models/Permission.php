<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'module',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
    ];

    protected function casts(): array
    {
        return [
            'can_view' => 'boolean',
            'can_create' => 'boolean',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean',
        ];
    }

    // Scopes
    public function scopeForRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeForModule($query, $module)
    {
        return $query->where('module', $module);
    }
}
