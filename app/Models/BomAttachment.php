<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bom_item_id',
        'file_type',
        'file_name',
        'file_path',
        'file_size',
        'description',
        'uploaded_by',
    ];

    // Relationships
    public function bomItem()
    {
        return $this->belongsTo(BomItem::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
