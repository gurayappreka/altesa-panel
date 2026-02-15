<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'company', 'email', 'phone', 'address',
        'tax_number', 'tax_office', 'notes', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
