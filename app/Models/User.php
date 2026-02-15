<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function uploadedFiles()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    // Helper Methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return in_array($this->role, ['admin', 'manager']);
    }

    public function hasAccess(string $module, string $permission): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        $perm = Permission::where('role', $this->role)
            ->where('module', $module)
            ->first();

        return $perm && $perm->{"can_$permission"} ?? false;
    }
}
