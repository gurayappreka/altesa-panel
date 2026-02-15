# Altesa Panel - Geliştirme Roadmap

## 📅 Geliştirme Planı

```
┌─────────────────────────────────────────────────────────────────┐
│                      ALTESA PANEL ROADMAP                       │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  FAZA 1          FAZA 2          FAZA 3          FAZA 4        │
│  Temel Yapı      CRM             SCM             Proje & Dosya │
│  ──────────      ───             ───             ─────────────  │
│  • Laravel       • Müşteri       • Tedarikçi     • Proje       │
│  • Auth          • Teklif        • Satın Alma    • Görev       │
│  • UI Base       • PDF           • Stok          • Dosya       │
│  • User                                                         │
│                                                                 │
│  ▓▓▓▓▓▓▓▓▓▓      ▓▓▓▓▓▓▓▓▓▓      ▓▓▓▓▓▓▓▓▓▓      ▓▓▓▓▓▓▓▓▓▓   │
│  Hafta 1-2       Hafta 3-4       Hafta 5-6       Hafta 7-8     │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🚀 FAZA 1: Temel Yapı (Hafta 1-2)

### Hafta 1: Proje Kurulumu

#### Gün 1-2: Laravel & Temel Yapılandırma
- [ ] Laravel 11 kurulumu
- [ ] SQLite yapılandırması
- [ ] Tailwind CSS + Alpine.js entegrasyonu
- [ ] Vite yapılandırması
- [ ] .env ayarları
- [ ] Git repo yapılandırması

#### Gün 3-4: Authentication
- [ ] Laravel Breeze kurulumu (Blade)
- [ ] Login sayfası tasarımı
- [ ] Şifre sıfırlama
- [ ] Remember me
- [ ] Session yönetimi

#### Gün 5: User & Role Sistemi
- [ ] User model ve migration
- [ ] Role enum (admin, manager, staff)
- [ ] CheckRole middleware
- [ ] User seeder (admin kullanıcı)

### Hafta 2: UI Altyapısı

#### Gün 1-2: Layout & Components
- [ ] Ana layout (app.blade.php)
- [ ] Responsive sidebar
- [ ] Mobile hamburger menu
- [ ] Header component
- [ ] Footer component

#### Gün 3-4: UI Components
- [ ] Button component
- [ ] Card component
- [ ] Table component (mobile responsive)
- [ ] Modal component
- [ ] Alert/Toast component
- [ ] Badge component
- [ ] Form inputs (input, select, textarea, checkbox)
- [ ] Pagination component

#### Gün 5: Dashboard & Profil
- [ ] Dashboard sayfası (placeholder)
- [ ] Profil düzenleme sayfası
- [ ] Şifre değiştirme

---

## 📋 FAZA 2: CRM Modülü (Hafta 3-4)

### Hafta 3: Müşteri & Teklif Temeli

#### Gün 1-2: Müşteri Yönetimi
- [ ] Customer model ve migration
- [ ] CustomerController
- [ ] Müşteri CRUD sayfaları
- [ ] Müşteri arama ve filtreleme
- [ ] Müşteri detay sayfası

#### Gün 3-5: Teklif Yönetimi (Temel)
- [ ] Quote model ve migration
- [ ] QuoteItem model ve migration
- [ ] QuoteController
- [ ] Otomatik teklif numarası üretimi
- [ ] Teklif oluşturma sayfası
- [ ] Dinamik kalem ekleme (Alpine.js)
- [ ] Teklif listeleme sayfası

### Hafta 4: Teklif Detayları

#### Gün 1-2: Teklif İşlemleri
- [ ] Teklif düzenleme
- [ ] Teklif detay sayfası
- [ ] Durum değiştirme
- [ ] Teklif kopyalama

#### Gün 3-4: PDF Çıktısı
- [ ] DomPDF kurulumu
- [ ] Teklif PDF template
- [ ] PDF indirme/görüntüleme
- [ ] Şirket logosu ve bilgileri

#### Gün 5: Activity Log
- [ ] ActivityLog model ve migration
- [ ] ActivityLogObserver
- [ ] HasActivityLog trait
- [ ] Log listeleme sayfası

---

## 🏭 FAZA 3: SCM Modülü (Hafta 5-6)

### Hafta 5: Tedarikçi & Satın Alma

#### Gün 1-2: Tedarikçi Yönetimi
- [ ] Supplier model ve migration
- [ ] SupplierController
- [ ] Tedarikçi CRUD sayfaları
- [ ] Tedarikçi arama

#### Gün 3-5: Satın Alma Yönetimi
- [ ] Purchase model ve migration
- [ ] PurchaseItem model ve migration
- [ ] PurchaseController
- [ ] Satın alma talebi oluşturma
- [ ] Satın alma listeleme
- [ ] Durum takibi

### Hafta 6: Depo/Stok Yönetimi

#### Gün 1-2: Ürün Tanımlama
- [ ] Product model ve migration
- [ ] ProductController
- [ ] Ürün CRUD sayfaları
- [ ] SKU yönetimi
- [ ] Tedarikçi ilişkilendirme

#### Gün 3-4: Stok Hareketleri
- [ ] StockMovement model ve migration
- [ ] StockService
- [ ] Stok giriş formu
- [ ] Stok çıkış formu
- [ ] Hareket geçmişi

#### Gün 5: Stok Entegrasyonları
- [ ] Satın alma teslim → Stok girişi
- [ ] Minimum stok uyarıları
- [ ] Ürün stok durumu dashboard widget

---

## 📁 FAZA 4: Proje & Dosya Modülü (Hafta 7-8)

### Hafta 7: Proje Yönetimi

#### Gün 1-2: Proje CRUD
- [ ] Project model ve migration
- [ ] ProjectController
- [ ] Proje oluşturma/düzenleme
- [ ] Proje listeleme (kart görünümü)
- [ ] Müşteri ilişkilendirme

#### Gün 3-5: Görev Yönetimi
- [ ] Task model ve migration
- [ ] TaskController
- [ ] Görev CRUD
- [ ] Görev atama
- [ ] Durum değiştirme
- [ ] "Bana atanan görevler" sayfası

### Hafta 8: Dosya Yönetimi & Bitiriş

#### Gün 1-3: Dosya Sistemi
- [ ] Folder model ve migration
- [ ] File model ve migration
- [ ] FileService
- [ ] Klasör oluşturma/silme
- [ ] Dosya yükleme (çoklu)
- [ ] Dosya indirme
- [ ] Dosya silme
- [ ] FTP benzeri arayüz

#### Gün 4: Yetkilendirme
- [ ] Permission model ve migration
- [ ] PermissionSeeder
- [ ] CheckModuleAccess middleware
- [ ] Yetki ayarları sayfası

#### Gün 5: Son Dokunuşlar
- [ ] Bug fixes
- [ ] UI tutarlılık kontrolü
- [ ] Mobile test
- [ ] Performans kontrolü
- [ ] README güncelleme
- [ ] Deployment hazırlığı

---

## 📊 Özet Tablo

| Faza | Modül | Süre | Öncelik |
|------|-------|------|---------|
| 1 | Temel Yapı | 2 hafta | 🔴 Kritik |
| 2 | CRM (Müşteri + Teklif) | 2 hafta | 🔴 Kritik |
| 3 | SCM (Tedarikçi + Satın Alma + Stok) | 2 hafta | 🟠 Yüksek |
| 4 | Proje + Dosya | 2 hafta | 🟡 Orta |

**Toplam Tahmini Süre: 8 Hafta**

---

## 🎯 MVP Kapsamı

İlk sürüm (MVP) için minimum gerekli özellikler:

### Olmazsa Olmaz ✅
- [x] Kullanıcı girişi
- [x] Müşteri yönetimi
- [x] Teklif oluşturma + PDF
- [x] Ürün/Stok takibi
- [x] Temel yetkilendirme

### İkinci Öncelik 🔄
- [ ] Satın alma modülü
- [ ] Proje yönetimi
- [ ] Dosya paylaşımı
- [ ] Activity logs

### Gelecek Sürümler 📈
- [ ] Dashboard raporları
- [ ] Bildirim sistemi
- [ ] Dark mode
- [ ] API endpoints
- [ ] Email entegrasyonu

---

## 🚦 Başlangıç Komutu

Onay verirsen FAZA 1'e başlayalım:

```bash
# Laravel projesi oluştur
composer create-project laravel/laravel altesa-panel

# Gerekli paketler
composer require barryvdh/laravel-dompdf
npm install -D tailwindcss postcss autoprefixer alpinejs
```

**Hazır mısın?** 🚀
