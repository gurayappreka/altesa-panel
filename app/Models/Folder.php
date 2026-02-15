<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'folderable_type',
        'folderable_id',
        'created_by',
    ];

    // Relationships
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function folderable()
    {
        return $this->morphTo();
    }

    // Helpers
    public function getPath(): string
    {
        $path = [$this->name];
        $folder = $this->parent;

        while ($folder) {
            array_unshift($path, $folder->name);
            $folder = $folder->parent;
        }

        return implode(' / ', $path);
    }
}
