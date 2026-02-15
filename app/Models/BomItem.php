<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'code', 'name', 'description', 'parent_id', 'level',
        'source_type', 'unit', 'unit_cost', 'lead_time_days',
        'drawing_number', 'revision', 'weight', 'material',
        'supplier_id', 'product_id', 'customer_id', 'status', 'is_template', 'created_by'
    ];

    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'unit_cost' => 'decimal:2',
            'weight' => 'decimal:3',
            'is_template' => 'boolean',
        ];
    }

    const TYPE_PROJECT = 'project';
    const TYPE_SUBPROJECT = 'subproject';
    const TYPE_PRODUCT = 'product';
    const TYPE_ASSEMBLY = 'assembly';
    const TYPE_PART = 'part';
    const TYPE_EQUIPMENT = 'equipment';

    // Relationships
    public function parent()
    {
        return $this->belongsTo(BomItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BomItem::class, 'parent_id');
    }

    public function ancestors()
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_closures',
            'descendant_id',
            'ancestor_id'
        )->withPivot('depth')->orderBy('depth', 'desc');
    }

    public function descendants()
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_closures',
            'ancestor_id',
            'descendant_id'
        )->withPivot('depth')->orderBy('depth');
    }

    public function components()
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_quantities',
            'parent_id',
            'child_id'
        )->withPivot(['quantity', 'unit', 'notes', 'sort_order'])
         ->orderBy('sort_order');
    }

    public function usedIn()
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_quantities',
            'child_id',
            'parent_id'
        )->withPivot(['quantity', 'unit', 'notes']);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function attachments()
    {
        return $this->hasMany(BomAttachment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeProjects($query)
    {
        return $query->where('type', self::TYPE_PROJECT);
    }

    public function scopeParts($query)
    {
        return $query->where('type', self::TYPE_PART);
    }

    public function scopeEquipment($query)
    {
        return $query->where('type', self::TYPE_EQUIPMENT);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
