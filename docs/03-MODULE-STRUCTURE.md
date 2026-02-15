# Altesa Panel - Modül Yapısı

## 📦 Modül Listesi

```
┌─────────────────────────────────────────────────────────┐
│                    ALTESA PANEL                         │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐     │
│  │   CORE      │  │   CRM       │  │   SCM       │     │
│  │   ─────     │  │   ───       │  │   ───       │     │
│  │ • Auth      │  │ • Müşteri   │  │ • Tedarikçi │     │
│  │ • User      │  │ • Teklif    │  │ • Satın Alma│     │
│  │ • Settings  │  │             │  │ • Depo      │     │
│  │ • Logs      │  │             │  │             │     │
│  └─────────────┘  └─────────────┘  └─────────────┘     │
│                                                         │
│  ┌─────────────┐  ┌─────────────┐                      │
│  │   PROJECT   │  │   FILES     │                      │
│  │   ───────   │  │   ─────     │                      │
│  │ • Proje     │  │ • Dosya     │                      │
│  │ • Görev     │  │ • Klasör    │                      │
│  │             │  │ • Paylaşım  │                      │
│  └─────────────┘  └─────────────┘                      │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

---

## 1️⃣ CORE Modülü (Çekirdek)

### Auth (Kimlik Doğrulama)
```
Özellikler:
├── Giriş yapma
├── Şifre sıfırlama
├── Oturum yönetimi
└── Remember me

Sayfalar:
├── /login
├── /forgot-password
└── /reset-password
```

### User (Kullanıcı Yönetimi)
```
Özellikler:
├── Kullanıcı CRUD
├── Rol atama (Admin/Yönetici/Personel)
├── Profil düzenleme
└── Aktif/Pasif durumu

Sayfalar:
├── /users (liste)
├── /users/create
├── /users/{id}/edit
└── /profile
```

### Settings (Ayarlar)
```
Özellikler:
├── Şirket bilgileri
├── Logo yükleme
├── Teklif numarası formatı
├── Satın alma numarası formatı
└── Modül bazlı yetki ayarları

Sayfalar:
├── /settings/general
├── /settings/company
└── /settings/permissions
```

### Activity Logs (İşlem Kayıtları)
```
Özellikler:
├── Tüm CRUD işlemlerinin kaydı
├── Kullanıcı bazlı filtreleme
├── Tarih bazlı filtreleme
└── Modül bazlı filtreleme

Sayfalar:
└── /logs
```

---

## 2️⃣ CRM Modülü (Müşteri İlişkileri)

### Müşteri Yönetimi
```
Özellikler:
├── Müşteri CRUD
├── İletişim bilgileri
├── Vergi bilgileri
├── Müşteriye ait teklifler listesi
├── Müşteriye ait projeler listesi
└── Arama ve filtreleme

Sayfalar:
├── /customers (liste)
├── /customers/create
├── /customers/{id}
└── /customers/{id}/edit
```

### Teklif Yönetimi
```
Özellikler:
├── Teklif CRUD
├── Otomatik teklif numarası
├── Kalem ekleme/çıkarma
├── Durum takibi (Hazırlanıyor/Gönderildi/Onaylandı/Reddedildi)
├── PDF çıktısı
├── Teklif geçmişi
└── Müşteri ilişkilendirme

Durumlar:
├── draft (Hazırlanıyor) - Sarı
├── sent (Gönderildi) - Mavi
├── approved (Onaylandı) - Yeşil
└── rejected (Reddedildi) - Kırmızı

Sayfalar:
├── /quotes (liste)
├── /quotes/create
├── /quotes/{id}
├── /quotes/{id}/edit
├── /quotes/{id}/pdf
└── /quotes/{id}/duplicate
```

---

## 3️⃣ SCM Modülü (Tedarik Zinciri)

### Tedarikçi Yönetimi
```
Özellikler:
├── Tedarikçi CRUD
├── İletişim bilgileri
├── Tedarikçiye ait ürünler
├── Tedarikçiye ait siparişler
└── Arama ve filtreleme

Sayfalar:
├── /suppliers (liste)
├── /suppliers/create
├── /suppliers/{id}
└── /suppliers/{id}/edit
```

### Satın Alma Yönetimi
```
Özellikler:
├── Satın alma talebi CRUD
├── Otomatik sipariş numarası
├── Kalem ekleme/çıkarma
├── Tedarikçi seçimi
├── Durum takibi (Beklemede/Sipariş Verildi/Teslim Edildi)
├── Beklenen teslim tarihi
└── Stok girişi entegrasyonu

Durumlar:
├── pending (Beklemede) - Sarı
├── ordered (Sipariş Verildi) - Mavi
├── delivered (Teslim Edildi) - Yeşil
└── cancelled (İptal Edildi) - Kırmızı

Sayfalar:
├── /purchases (liste)
├── /purchases/create
├── /purchases/{id}
├── /purchases/{id}/edit
└── /purchases/{id}/receive (teslim alma)
```

### Depo/Stok Yönetimi
```
Özellikler:
├── Ürün CRUD
├── SKU (stok kodu) tanımlama
├── Stok miktarı takibi
├── Minimum stok seviyesi
├── Stok giriş işlemi
├── Stok çıkış işlemi
├── Hareket geçmişi
├── Düşük stok uyarıları
└── Tedarikçi bağlantısı

Sayfalar:
├── /products (liste)
├── /products/create
├── /products/{id}
├── /products/{id}/edit
├── /products/{id}/movements (hareket geçmişi)
├── /stock/in (stok girişi)
├── /stock/out (stok çıkışı)
└── /stock/alerts (düşük stok uyarıları)
```

---

## 4️⃣ PROJECT Modülü (Proje Yönetimi)

### Proje Yönetimi
```
Özellikler:
├── Proje CRUD
├── Müşteri atama
├── Durum takibi
├── Öncelik belirleme
├── Başlangıç/Bitiş tarihleri
├── Proje dosyaları
└── Görev listesi

Durumlar:
├── planning (Planlama) - Gri
├── active (Aktif) - Mavi
├── on_hold (Beklemede) - Sarı
├── completed (Tamamlandı) - Yeşil
└── cancelled (İptal) - Kırmızı

Sayfalar:
├── /projects (liste - kart görünümü)
├── /projects/create
├── /projects/{id}
├── /projects/{id}/edit
└── /projects/{id}/tasks
```

### Görev Yönetimi
```
Özellikler:
├── Görev CRUD
├── Projeye bağlı görevler
├── Kullanıcı atama
├── Son tarih belirleme
├── Durum takibi (Yapılacak/Devam Ediyor/Tamamlandı)
├── Sürükle-bırak sıralama
└── Kanban görünümü (opsiyonel)

Durumlar:
├── todo (Yapılacak) - Gri
├── in_progress (Devam Ediyor) - Mavi
└── done (Tamamlandı) - Yeşil

Sayfalar:
├── /projects/{id}/tasks (proje içinde)
├── /tasks (tüm görevler - filtrelenebilir)
└── /my-tasks (bana atanan görevler)
```

---

## 5️⃣ FILES Modülü (Dosya Yönetimi)

### Dosya ve Klasör Yönetimi
```
Özellikler:
├── FTP benzeri arayüz
├── Klasör CRUD
├── Dosya yükleme (çoklu)
├── Dosya indirme
├── Dosya önizleme (resim/pdf)
├── Proje/Müşteri ilişkilendirme
├── Arama
└── Yetkilendirme

İzin Verilen Dosya Türleri:
├── Resim: jpg, jpeg, png, gif, webp
├── Doküman: pdf, doc, docx, xls, xlsx
├── Arşiv: zip, rar
└── Diğer: txt, csv

Sayfalar:
├── /files (ana dizin)
├── /files/folder/{id}
└── /files/search
```

---

## 🔐 Yetki Matrisi

| Modül | Admin | Yönetici | Personel |
|-------|-------|----------|----------|
| Kullanıcılar | CRUD | R | - |
| Ayarlar | CRUD | R | - |
| Loglar | R | R | - |
| Müşteriler | CRUD | CRUD | R |
| Teklifler | CRUD | CRUD | CR |
| Tedarikçiler | CRUD | CRUD | R |
| Satın Alma | CRUD | CRUD | CR |
| Ürünler | CRUD | CRUD | R |
| Stok İşlemleri | CRUD | CRUD | CR |
| Projeler | CRUD | CRUD | R |
| Görevler | CRUD | CRUD | CRU (kendi) |
| Dosyalar | CRUD | CRUD | CR |

**CRUD:** Create, Read, Update, Delete  
**R:** Sadece okuma  
**CR:** Oluşturma ve okuma  
**CRU:** Oluşturma, okuma, güncelleme
