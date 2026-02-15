# Altesa Panel - Özellikler ve Modüller

## 📊 Genel Bakış

Altesa Panel, endüstriyel otomasyon şirketleri için özel olarak tasarlanmış, modüler bir yönetim sistemidir.

## ✅ Tamamlanan Modüller

### 1. 🏠 Dashboard

**Özellikler:**
- ✅ 6 istatistik kartı (müşteriler, teklifler, satın alma, stok, projeler, görevler)
- ✅ Son 5 teklif listesi
- ✅ Kullanıcının görevleri
- ✅ Düşük stok uyarıları tablosu
- ✅ Responsive tasarım

**Ekran Görüntüsü Yolu:** `/dashboard`

---

### 2. 👥 Müşteri Yönetimi

**Özellikler:**
- ✅ Müşteri listesi (sayfalama ile)
- ✅ Müşteri ekleme formu
- ✅ Müşteri düzenleme
- ✅ Müşteri silme
- ✅ Müşteri detay sayfası (teklifler ve projeler ile)
- ✅ Aktif/Pasif durum kontrolü

**Veri Alanları:**
- İsim, Şirket
- E-posta, Telefon
- Adres
- Vergi No, Vergi Dairesi
- Notlar

**Ekran Görüntüsü Yolu:** `/customers`

---

### 3. 📝 Teklif Yönetimi

**Özellikler:**
- ✅ Teklif listesi
- ✅ Teklif oluşturma (çoklu kalem)
- ✅ Teklif düzenleme
- ✅ Durum yönetimi (Taslak, Gönderildi, Onaylandı, Reddedildi)
- ✅ Otomatik teklif numarası (TKL-2026-00001)
- ✅ KDV hesaplama (%18)
- ✅ Alt toplam ve genel toplam

**Veri Alanları:**
- Müşteri
- Geçerlilik tarihi
- Durum
- Kalemler (ürün, açıklama, miktar, birim, birim fiyat)
- Notlar

**Ekran Görüntüsü Yolu:** `/quotes`

---

### 4. 🏭 Tedarikçi Yönetimi

**Özellikler:**
- ✅ Tedarikçi listesi
- ✅ Tedarikçi ekleme
- ✅ Tedarikçi düzenleme
- ✅ Tedarikçi silme
- ✅ Tedarikçi detay (ürünler ve satın almalar)

**Veri Alanları:**
Müşteri ile aynı

**Ekran Görüntüsü Yolu:** `/suppliers`

---

### 5. 🛒 Satın Alma Yönetimi

**Özellikler:**
- ✅ Satın alma talepleri listesi
- ✅ Talep oluşturma (çoklu kalem)
- ✅ Durum yönetimi (Beklemede, Sipariş Verildi, Teslim Alındı, İptal)
- ✅ Otomatik sipariş numarası (SIP-2026-00001)
- ✅ Beklenen ve teslim tarihleri

**Veri Alanları:**
- Tedarikçi
- Tarihler
- Durum
- Kalemler (ürün, açıklama, miktar, birim, birim fiyat)
- Notlar

**Ekran Görüntüsü Yolu:** `/purchases`

---

### 6. 📦 Ürün/Stok Yönetimi

**Özellikler:**
- ✅ Ürün listesi
- ✅ Ürün ekleme/düzenleme
- ✅ Stok seviyesi takibi
- ✅ Minimum stok uyarısı
- ✅ Stok hareketleri (giriş/çıkış)
- ✅ Tedarikçi bağlantısı
- ✅ SKU kodu
- ✅ Konum bilgisi

**Veri Alanları:**
- İsim, SKU
- Açıklama
- Birim (Adet, KG, M, vb.)
- Stok miktarı
- Minimum seviye
- Tedarikçi
- Konum

**Ekran Görüntüsü Yolu:** `/products`

**Stok Uyarıları:** `/stock/alerts`

---

### 7. 📋 Proje Yönetimi

**Özellikler:**
- ✅ Proje listesi
- ✅ Proje ekleme/düzenleme
- ✅ Durum yönetimi (Planlama, Aktif, Beklemede, Tamamlandı, İptal)
- ✅ Öncelik seviyeleri (Düşük, Orta, Yüksek)
- ✅ Müşteri bağlantısı
- ✅ Başlangıç ve bitiş tarihleri
- ✅ İlerleme yüzdesi (görevlere göre)

**Veri Alanları:**
- Proje adı
- Müşteri
- Durum, Öncelik
- Tarihler
- Açıklama

**Ekran Görüntüsü Yolu:** `/projects`

---

### 8. ✅ Görev Yönetimi

**Özellikler:**
- ✅ Projeye bağlı görevler
- ✅ Görev ekleme/düzenleme
- ✅ Durum yönetimi (Yapılacak, Devam Ediyor, Tamamlandı)
- ✅ Kullanıcıya atama
- ✅ Termin tarihi
- ✅ "Görevlerim" sayfası
- ✅ Geciken görevler vurgusu

**Veri Alanları:**
- Başlık
- Açıklama
- Durum
- Atanan kişi
- Termin tarihi

**Ekran Görüntüsü Yolu:** `/tasks/my`

---

### 9. 📁 Dosya Yönetimi

**Özellikler:**
- ✅ Klasör yapısı
- ✅ Dosya yükleme
- ✅ Dosya listeleme
- ✅ Polymorphic ilişki (her kayda dosya eklenebilir)
- ✅ Dosya boyutu kontrolü (max 10MB)
- ✅ MIME type kontrolü

**Desteklenen Formatlar:**
- Resim: JPG, PNG, GIF, WebP
- Doküman: PDF, DOC, DOCX, XLS, XLSX
- Diğer: ZIP, RAR, TXT, CSV

**Ekran Görüntüsü Yolu:** `/files`

---

### 10. 👤 Kullanıcı Yönetimi

**Özellikler:**
- ✅ Kullanıcı listesi
- ✅ Kullanıcı ekleme/düzenleme
- ✅ Rol yönetimi (Admin, Manager, Staff)
- ✅ Aktif/Pasif durum
- ✅ Şifre değiştirme

**Roller:**
- **Admin:** Tüm yetkilere sahip
- **Manager:** Çoğu işlem + görüntüleme, kullanıcı/ayar değiştirme yok
- **Staff:** Sınırlı yetki (teklif, satın alma, görevler)

**Ekran Görüntüsü Yolu:** `/users` (Sadece admin)

---

### 11. 🌲 BOM (Ürün Ağaçları) Modülü

**Özellikler:**
- ✅ Hiyerarşik yapı (Proje > Alt Proje > Ürün > Grup > Parça/Ekipman)
- ✅ Closure table pattern (hızlı sorgular)
- ✅ Adet yönetimi
- ✅ Maliyet hesaplama
- ✅ Malzeme ihtiyaç listesi
- ✅ "Nerelerde kullanılıyor" sorgusu
- ✅ Depo entegrasyonu
- ✅ Teknik resim ve doküman ekleri

**Veri Alanları:**
- Tip (Project, Subproject, Product, Assembly, Part, Equipment)
- Kod, İsim
- Hiyerarşi ilişkileri
- Kaynak tipi (Üretim, Satın Alma, Stoktan)
- Birim maliyet, Lead time
- Teknik resim no, Revizyon
- Ağırlık, Malzeme

**Veritabanı Tabloları:**
- `bom_items` - Ana tablo
- `bom_closures` - Hiyerarşi ilişkileri
- `bom_quantities` - Adet bilgileri
- `bom_attachments` - Dosya ekleri

---

## 🔒 Güvenlik ve Yetkilendirme

### Rol Tabanlı Erişim Kontrolü

**Middleware:**
- `CheckRole` - Rol kontrolü
- `CheckModuleAccess` - Modül bazlı yetki kontrolü

**Permission Tablosu:**
Her rol için her modülde 4 yetki:
- `can_view` - Görüntüleme
- `can_create` - Oluşturma
- `can_edit` - Düzenleme
- `can_delete` - Silme

**Örnek Yetki Matrisi:**

| Modül | Admin | Manager | Staff |
|-------|-------|---------|-------|
| Customers | ✅✅✅✅ | ✅✅✅❌ | ✅✅❌❌ |
| Quotes | ✅✅✅✅ | ✅✅✅❌ | ✅✅✅❌ |
| Suppliers | ✅✅✅✅ | ✅✅✅❌ | ❌❌❌❌ |
| Users | ✅✅✅✅ | ✅❌❌❌ | ❌❌❌❌ |

---

## 📱 Responsive Tasarım

### Breakpoint'ler

- **Mobile:** < 768px (Hamburger menu)
- **Tablet:** 768px - 1024px
- **Desktop:** > 1024px (Fixed sidebar)

### Mobile Özellikler

- ✅ Hamburger menu
- ✅ Touch-friendly butonlar
- ✅ Swipe destekli tablolar
- ✅ Collapsed sidebar (overlay)
- ✅ Stack layout (mobilde dikey)

---

## 🎨 UI Bileşenleri

### Tailwind Utility Classes

```css
.btn - Buton
.btn-primary - Birincil buton (mavi)
.btn-secondary - İkincil buton (gri)
.btn-success - Başarı butonu (yeşil)
.btn-danger - Tehlike butonu (kırmızı)
.btn-sm - Küçük buton

.card - Kart container
.input - Input alanı
.badge - Rozet
.badge-{color} - Renkli rozet
```

### Alpine.js Data Components

```javascript
sidebar() - Sidebar toggle
dropdown() - Dropdown menu
modal() - Modal dialog
```

---

## 📊 Veritabanı İstatistikleri

**Tablo Sayısı:** 21
**Model Sayısı:** 16
**Migration Sayısı:** 18
**Seeder Sayısı:** 2

### Önemli İlişkiler

- Quote → Customer (1:N)
- Quote → QuoteItems (1:N)
- Purchase → Supplier (1:N)
- Project → Tasks (1:N)
- Task → User (assigned)
- Product → Supplier (1:N)
- BomItem → BomItem (parent-child)

---

## 🚀 Performans

### Optimizasyon

- ✅ Eager loading (N+1 sorgusu önleme)
- ✅ Index'ler (foreign key'ler)
- ✅ Pagination (15 kayıt/sayfa)
- ✅ Asset bundling (Vite)
- ✅ CSS purge (production)

---

## 📝 Kod İstatistikleri

- **Controller:** 13 dosya
- **Model:** 16 dosya
- **Migration:** 18 dosya
- **View:** 20+ dosya
- **Route:** 50+ route tanımı

---

## 🔄 Gelecek Güncellemeler

### Faz 2 (Öncelikli)

- [ ] PDF teklif çıktısı (DomPDF)
- [ ] Excel export (Maatwebsite/Excel)
- [ ] Activity log görüntüleme
- [ ] Dashboard grafikleri (Chart.js)
- [ ] E-posta bildirimleri

### Faz 3 (İyileştirmeler)

- [ ] Gelişmiş filtreleme
- [ ] Toplu işlemler
- [ ] Favoriler sistemi
- [ ] Dark mode
- [ ] Multi-language

### Faz 4 (BOM Geliştirmeleri)

- [ ] BOM tree view (drag & drop)
- [ ] BOM template'leri
- [ ] Otomatik satın alma talebi
- [ ] Cost breakdown raporu

---

**Son Güncelleme:** {{ date('Y-m-d H:i') }}  
**Versiyon:** 1.0.0
