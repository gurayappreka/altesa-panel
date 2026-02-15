# Altesa Panel - Ürün Ağaçları (BOM) Modülü

## 🎯 Genel Bakış

Bill of Materials (BOM) modülü, üretim süreçlerindeki hiyerarşik yapıyı yönetir.

```
┌─────────────────────────────────────────────────────────────────┐
│                      PROJE (En Üst Seviye)                      │
│  Örn: "ABC Fabrikası Otomasyon Projesi"                        │
├─────────────────────────────────────────────────────────────────┤
│    ┌─────────────────┐    ┌─────────────────┐                  │
│    │   ALT PROJE 1   │    │   ALT PROJE 2   │                  │
│    │ "Hat 1 Montaj"  │    │ "Hat 2 Montaj"  │                  │
│    └────────┬────────┘    └────────┬────────┘                  │
│             │                      │                            │
│    ┌────────┴────────┐    ┌────────┴────────┐                  │
│    │     ÜRÜN        │    │     ÜRÜN        │                  │
│    │ "Robot Hücre A" │    │ "Konveyör Sis." │                  │
│    └────────┬────────┘    └────────┬────────┘                  │
│             │                      │                            │
│    ┌────────┴────────┐    ┌────────┴────────┐                  │
│    │     GRUP        │    │     GRUP        │                  │
│    │ "Gripper Asm."  │    │ "Tahrik Grubu"  │                  │
│    └────────┬────────┘    └────────┬────────┘                  │
│             │                      │                            │
│    ┌────────┴────────┬─────────────┴────────┐                  │
│    │                 │                      │                  │
│  ┌─┴──┐           ┌──┴──┐              ┌───┴───┐              │
│  │PARÇA│           │PARÇA│              │EKİPMAN│              │
│  │Plaka│           │Mil  │              │Motor  │              │
│  └─────┘           └─────┘              └───────┘              │
└─────────────────────────────────────────────────────────────────┘
```

## 📊 Hiyerarşi Seviyeleri

| Seviye | Türkçe | İngilizce | Açıklama |
|--------|--------|-----------|----------|
| 1 | Proje | Project | En üst seviye, müşteri projesi |
| 2 | Alt Proje | Sub-Project | Projenin alt bölümleri |
| 3 | Ürün | Product | Teslim edilebilir birimler (fikstür, hücre vb.) |
| 4 | Grup | Assembly | Montaj grupları |
| 5 | Parça | Part | İmal edilen veya satın alınan parçalar |
| 5 | Ekipman | Equipment | Standart satın alma ürünleri |

---

## 🗄️ Veri Modeli

### Yaklaşım: Single Table Inheritance (STI) + Closure Table

**Neden bu yaklaşım?**
- ✅ SQLite uyumlu
- ✅ Sınırsız derinlik desteği
- ✅ Hızlı ancestor/descendant sorguları
- ✅ Laravel Eloquent ile uyumlu

```
┌──────────────────────────────────────────────────────────────┐
│                      BOM ITEMS TABLE                         │
│  (Tüm seviyeler tek tabloda - STI Pattern)                  │
├──────────────────────────────────────────────────────────────┤
│ id | type      | code     | name          | parent_id | ... │
├────┼───────────┼──────────┼───────────────┼───────────┼─────┤
│ 1  | project   | PRJ-001  | ABC Fabrikası | NULL      |     │
│ 2  | subproj   | SP-001   | Hat 1 Montaj  | 1         |     │
│ 3  | product   | PRD-001  | Robot Hücre   | 2         |     │
│ 4  | assembly  | ASM-001  | Gripper Asm   | 3         |     │
│ 5  | part      | PRT-001  | Plaka         | 4         |     │
│ 6  | equipment | EQP-001  | Servo Motor   | 4         |     │
└──────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────┐
│                    BOM CLOSURE TABLE                         │
│  (Hiyerarşi ilişkileri için - Ancestor/Descendant)          │
├──────────────────────────────────────────────────────────────┤
│ ancestor_id | descendant_id | depth                          │
├─────────────┼───────────────┼────────────────────────────────┤
│ 1           | 1             | 0  (self)                      │
│ 1           | 2             | 1  (proje → alt proje)         │
│ 1           | 3             | 2  (proje → ürün)              │
│ 1           | 4             | 3  (proje → grup)              │
│ 1           | 5             | 4  (proje → parça)             │
│ 2           | 2             | 0  (self)                      │
│ 2           | 3             | 1  (alt proje → ürün)          │
│ ...         | ...           | ...                            │
└──────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────┐
│                   BOM QUANTITIES TABLE                       │
│  (Adet bilgisi - Parent-Child arası)                        │
├──────────────────────────────────────────────────────────────┤
│ parent_id | child_id | quantity | unit   | notes            │
├───────────┼──────────┼──────────┼────────┼──────────────────┤
│ 4         | 5        | 2        | Adet   | Sol ve sağ plaka │
│ 4         | 6        | 1        | Adet   | Ana tahrik       │
│ ...       | ...      | ...      | ...    | ...              │
└──────────────────────────────────────────────────────────────┘
```

---

## 📋 Tablo Yapıları

### 1. bom_items (Ana Tablo)

```sql
CREATE TABLE bom_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    
    -- Temel Bilgiler
    type VARCHAR(20) NOT NULL,  -- project, subproject, product, assembly, part, equipment
    code VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    
    -- Hiyerarşi
    parent_id INTEGER NULL,
    level INTEGER DEFAULT 0,  -- 0=project, 1=subproject, 2=product, 3=assembly, 4=part/equipment
    
    -- Parça/Ekipman Özellikleri
    source_type VARCHAR(20) NULL,  -- manufacture, purchase, stock
    unit VARCHAR(20) DEFAULT 'Adet',
    unit_cost DECIMAL(15,2) NULL,
    lead_time_days INTEGER NULL,
    
    -- Teknik Bilgiler
    drawing_number VARCHAR(50) NULL,  -- Teknik resim no
    revision VARCHAR(10) NULL,
    weight DECIMAL(10,3) NULL,  -- kg
    material VARCHAR(100) NULL,
    
    -- İlişkiler
    supplier_id INTEGER NULL,
    product_id INTEGER NULL,  -- Depo modülü bağlantısı
    customer_id INTEGER NULL,  -- Proje için müşteri
    
    -- Durum
    status VARCHAR(20) DEFAULT 'active',  -- active, obsolete, draft
    is_template BOOLEAN DEFAULT 0,  -- Şablon olarak kullanılabilir mi?
    
    -- Meta
    created_by INTEGER NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (parent_id) REFERENCES bom_items(id) ON DELETE SET NULL,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Indexler
CREATE INDEX idx_bom_items_type ON bom_items(type);
CREATE INDEX idx_bom_items_parent ON bom_items(parent_id);
CREATE INDEX idx_bom_items_code ON bom_items(code);
```

### 2. bom_closures (Closure Table)

```sql
CREATE TABLE bom_closures (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ancestor_id INTEGER NOT NULL,
    descendant_id INTEGER NOT NULL,
    depth INTEGER NOT NULL DEFAULT 0,
    
    FOREIGN KEY (ancestor_id) REFERENCES bom_items(id) ON DELETE CASCADE,
    FOREIGN KEY (descendant_id) REFERENCES bom_items(id) ON DELETE CASCADE,
    UNIQUE(ancestor_id, descendant_id)
);

-- Indexler
CREATE INDEX idx_bom_closures_ancestor ON bom_closures(ancestor_id);
CREATE INDEX idx_bom_closures_descendant ON bom_closures(descendant_id);
CREATE INDEX idx_bom_closures_depth ON bom_closures(depth);
```

### 3. bom_quantities (Adet İlişkileri)

```sql
CREATE TABLE bom_quantities (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    parent_id INTEGER NOT NULL,
    child_id INTEGER NOT NULL,
    quantity DECIMAL(10,4) NOT NULL DEFAULT 1,
    unit VARCHAR(20) DEFAULT 'Adet',
    notes TEXT NULL,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (parent_id) REFERENCES bom_items(id) ON DELETE CASCADE,
    FOREIGN KEY (child_id) REFERENCES bom_items(id) ON DELETE CASCADE,
    UNIQUE(parent_id, child_id)
);
```

### 4. bom_attachments (Dosya Ekleri)

```sql
CREATE TABLE bom_attachments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    bom_item_id INTEGER NOT NULL,
    file_type VARCHAR(20) NOT NULL,  -- drawing, document, image, other
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INTEGER NULL,
    description TEXT NULL,
    uploaded_by INTEGER NULL,
    created_at TIMESTAMP,
    
    FOREIGN KEY (bom_item_id) REFERENCES bom_items(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);
```

---

## 🔗 İlişki Diyagramı

```
┌─────────────────────────────────────────────────────────────────────┐
│                        BOM MODULE RELATIONS                         │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  ┌─────────────┐         ┌─────────────┐         ┌─────────────┐  │
│  │  customers  │────────▶│  bom_items  │◀────────│  suppliers  │  │
│  └─────────────┘   1:N   │   (type=    │   N:1   └─────────────┘  │
│                          │   project)  │                          │
│                          └──────┬──────┘                          │
│                                 │                                  │
│                          ┌──────┴──────┐                          │
│                          │             │                          │
│                    ┌─────┴─────┐ ┌─────┴─────┐                    │
│                    │bom_closure│ │bom_quantit│                    │
│                    │    (N:N)  │ │   (N:N)   │                    │
│                    └───────────┘ └───────────┘                    │
│                                                                    │
│                          ┌──────────────┐                          │
│                          │   products   │◀─── Depo Modülü         │
│                          │   (Stok)     │                          │
│                          └──────┬───────┘                          │
│                                 │ 1:N                              │
│                          ┌──────┴───────┐                          │
│                          │  bom_items   │                          │
│                          │ (type=part/  │                          │
│                          │  equipment)  │                          │
│                          └──────────────┘                          │
│                                                                     │
│  ┌─────────────┐                              ┌─────────────┐      │
│  │  purchases  │◀─────────────────────────────│  bom_items  │      │
│  │  (Satın Al) │  Otomatik talep oluşturma   │             │      │
│  └─────────────┘                              └─────────────┘      │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

---

## ⚙️ Laravel Model İlişkileri

### BomItem Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BomItem extends Model
{
    protected $fillable = [
        'type', 'code', 'name', 'description', 'parent_id', 'level',
        'source_type', 'unit', 'unit_cost', 'lead_time_days',
        'drawing_number', 'revision', 'weight', 'material',
        'supplier_id', 'product_id', 'customer_id', 'status', 'is_template'
    ];

    // Type constants
    const TYPE_PROJECT = 'project';
    const TYPE_SUBPROJECT = 'subproject';
    const TYPE_PRODUCT = 'product';
    const TYPE_ASSEMBLY = 'assembly';
    const TYPE_PART = 'part';
    const TYPE_EQUIPMENT = 'equipment';

    // Source types
    const SOURCE_MANUFACTURE = 'manufacture';
    const SOURCE_PURCHASE = 'purchase';
    const SOURCE_STOCK = 'stock';

    // ─── Direct Parent/Children ─────────────────────────────────
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BomItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(BomItem::class, 'parent_id');
    }

    // ─── Closure Table Relations (Tüm Atalar/Torunlar) ──────────

    public function ancestors(): BelongsToMany
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_closures',
            'descendant_id',
            'ancestor_id'
        )->withPivot('depth')->orderBy('depth', 'desc');
    }

    public function descendants(): BelongsToMany
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_closures',
            'ancestor_id',
            'descendant_id'
        )->withPivot('depth')->orderBy('depth');
    }

    // ─── Quantity Relations ─────────────────────────────────────

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_quantities',
            'parent_id',
            'child_id'
        )->withPivot(['quantity', 'unit', 'notes', 'sort_order'])
         ->orderBy('sort_order');
    }

    public function usedIn(): BelongsToMany
    {
        return $this->belongsToMany(
            BomItem::class,
            'bom_quantities',
            'child_id',
            'parent_id'
        )->withPivot(['quantity', 'unit', 'notes']);
    }

    // ─── External Relations ─────────────────────────────────────

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(BomAttachment::class);
    }

    // ─── Scopes ─────────────────────────────────────────────────

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

    // ─── Helper Methods ─────────────────────────────────────────

    /**
     * Bu parça nerelerde kullanılıyor?
     */
    public function getWhereUsed(): Collection
    {
        return $this->usedIn()
            ->with('ancestors')
            ->get()
            ->map(function ($item) {
                return [
                    'item' => $item,
                    'quantity' => $item->pivot->quantity,
                    'path' => $this->buildPath($item),
                ];
            });
    }

    /**
     * Toplam ihtiyaç hesapla (recursive)
     */
    public function getTotalRequirements(float $multiplier = 1): Collection
    {
        $requirements = collect();

        foreach ($this->components as $component) {
            $qty = $component->pivot->quantity * $multiplier;

            if (in_array($component->type, [self::TYPE_PART, self::TYPE_EQUIPMENT])) {
                $requirements->push([
                    'item' => $component,
                    'total_quantity' => $qty,
                ]);
            }

            // Recursive call for assemblies
            if ($component->type === self::TYPE_ASSEMBLY) {
                $subRequirements = $component->getTotalRequirements($qty);
                $requirements = $requirements->merge($subRequirements);
            }
        }

        // Aynı parçaları grupla ve topla
        return $requirements->groupBy('item.id')->map(function ($items) {
            return [
                'item' => $items->first()['item'],
                'total_quantity' => $items->sum('total_quantity'),
            ];
        })->values();
    }
}
```

---

## 📝 Örnek Kullanım Senaryoları

### Senaryo 1: Yeni Proje Oluşturma

```php
// 1. Proje oluştur
$project = BomItem::create([
    'type' => 'project',
    'code' => 'PRJ-2026-001',
    'name' => 'ABC Fabrikası Robot Hücresi',
    'customer_id' => 5,
]);

// 2. Alt proje ekle
$subProject = BomItem::create([
    'type' => 'subproject',
    'code' => 'SP-001',
    'name' => 'Kaynak Hattı',
    'parent_id' => $project->id,
]);

// 3. Ürün ekle
$product = BomItem::create([
    'type' => 'product',
    'code' => 'PRD-GRIPPER-01',
    'name' => 'Pneumatik Gripper',
    'parent_id' => $subProject->id,
]);

// 4. Montaj grubu ekle
$assembly = BomItem::create([
    'type' => 'assembly',
    'code' => 'ASM-FINGER-01',
    'name' => 'Parmak Mekanizması',
    'parent_id' => $product->id,
]);

// 5. Parça ekle (adet bilgisiyle)
$part = BomItem::create([
    'type' => 'part',
    'code' => 'PRT-PLATE-01',
    'name' => 'Bağlantı Plakası',
    'source_type' => 'manufacture',
    'drawing_number' => 'DWG-2026-0150',
]);

// 6. Adet ilişkisi kur
$assembly->components()->attach($part->id, [
    'quantity' => 2,
    'unit' => 'Adet',
    'notes' => 'Sol ve sağ plaka',
]);
```

### Senaryo 2: "Bu Parça Nerelerde Kullanılıyor?"

```php
$part = BomItem::where('code', 'PRT-PLATE-01')->first();

$usages = $part->getWhereUsed();

// Sonuç:
// [
//   ['item' => ASM-FINGER-01, 'quantity' => 2, 'path' => 'PRJ-001 > SP-001 > PRD-001 > ASM-001'],
//   ['item' => ASM-FINGER-02, 'quantity' => 4, 'path' => 'PRJ-002 > SP-003 > PRD-005 > ASM-010'],
// ]
```

### Senaryo 3: Toplam İhtiyaç Listesi Çıkarma

```php
$project = BomItem::where('code', 'PRJ-2026-001')->first();

$requirements = $project->getTotalRequirements();

// Sonuç:
// [
//   ['item' => PRT-PLATE-01, 'total_quantity' => 48],
//   ['item' => PRT-SHAFT-01, 'total_quantity' => 24],
//   ['item' => EQP-MOTOR-01, 'total_quantity' => 12],
//   ...
// ]

// Depo kontrolü yap
foreach ($requirements as $req) {
    $stockProduct = $req['item']->stockProduct;
    if ($stockProduct) {
        $available = $stockProduct->stock_quantity;
        $needed = $req['total_quantity'];
        $shortage = max(0, $needed - $available);
        
        if ($shortage > 0) {
            // Satın alma talebi oluştur
        }
    }
}
```

### Senaryo 4: Maliyet Hesaplama

```php
public function calculateTotalCost(): float
{
    $total = 0;

    foreach ($this->components as $component) {
        $qty = $component->pivot->quantity;

        if ($component->unit_cost) {
            $total += $component->unit_cost * $qty;
        }

        // Recursive
        if ($component->components->count() > 0) {
            $total += $component->calculateTotalCost() * $qty;
        }
    }

    return $total;
}

// Kullanım
$project = BomItem::find(1);
$totalCost = $project->calculateTotalCost(); // ₺125,430.50
```

---

## 🖥️ UI Sayfaları

### 1. BOM Ağacı Görünümü
```
/bom/{project}/tree
├── Ağaç yapısı (expandable/collapsible)
├── Drag & drop sıralama
├── Sağ tık context menu
└── Quick add inline form
```

### 2. Parça/Ekipman Listesi
```
/bom/parts
├── Filtreleme (tip, tedarikçi, durum)
├── Arama
├── "Nerelerde kullanılıyor" butonu
└── Toplu düzenleme
```

### 3. İhtiyaç Raporu
```
/bom/{project}/requirements
├── Toplam parça listesi
├── Stok durumu karşılaştırması
├── Eksik parçalar
├── Satın alma talebi oluşturma
└── Excel export
```

### 4. Şablon Yönetimi
```
/bom/templates
├── Şablon olarak kaydet
├── Şablondan oluştur
└── Şablon kütüphanesi
```

---

## 🔄 Modül Entegrasyonları

### Depo Modülü
```
BOM Part/Equipment ──────▶ Products (Stok)
                              │
                              ▼
                         stock_quantity
                         min_stock_level
```

### Satın Alma Modülü
```
BOM İhtiyaç Raporu ──────▶ Purchase Request
                              │
                              ▼
                         Otomatik kalem ekleme
                         Tedarikçi önerisi
```

### Proje Modülü
```
BOM Project ◀────────────▶ Projects
                              │
                              ▼
                         Görev oluşturma
                         İlerleme takibi
```

---

## ✅ Onay Bekleyen

Bu modülü mevcut roadmap'e ekleyeyim mi?

**Önerilen Faz:** FAZA 5 (Hafta 9-10)

| Gün | Görev |
|-----|-------|
| 1-2 | Tablo yapıları ve migration |
| 3-4 | Model ilişkileri ve servisler |
| 5 | BOM ağacı UI (tree view) |
| 6-7 | İhtiyaç raporu ve hesaplamalar |
| 8 | Depo/Satın alma entegrasyonu |
| 9-10 | Test ve iyileştirmeler |
