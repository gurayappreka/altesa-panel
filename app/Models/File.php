<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'original_name',
        'path',
        'mime_type',
        'size',
        'folder_id',
        'fileable_type',
        'fileable_id',
        'uploaded_by',
    ];

    // Relationships
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function fileable()
    {
        return $this->morphTo();
    }

    // Helpers
    public function getUrl(): string
    {
        return Storage::url($this->path);
    }

    public function getHumanSize(): string
    {
        if (!$this->size) return 'N/A';

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    public function isImage(): bool
    {
        return in_array($this->mime_type, [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/webp'
        ]);
    }

    public function isPdf(): bool
    {
        return $this->mime_type === 'application/pdf';
    }
}
