# Altesa ERP - Kurumsal Sistem Mimarisi

## 🎯 Vizyon

SAP seviyesine yakın, modüler, ölçeklenebilir bir ERP+CRM sistemi.

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                           ALTESA ERP PLATFORM                               │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────┐   │
│  │                        PORTAL LAYER                                  │   │
│  │  Dashboard │ Notifications │ Search │ Reports │ User Preferences    │   │
│  └─────────────────────────────────────────────────────────────────────┘   │
│                                                                             │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐  │
│  │   CRM   │ │ PROJECT │ │PRODUCTN │ │   SCM   │ │   WMS   │ │   DMS   │  │
│  │         │ │  MGMT   │ │  (MES)  │ │         │ │         │ │         │  │
│  │•Accounts│ │•Projects│ │•BOM     │ │•Purchase│ │•Stock   │ │•Files   │  │
│  │•Contacts│ │•Tasks   │ │•WorkOrd │ │•Supplier│ │•Warehou │ │•Folders │  │
│  │•Leads   │ │•Gantt   │ │•Routing │ │•RFQ     │ │•Invntry │ │•Version │  │
│  │•Opports │ │•Resource│ │•Quality │ │•Contract│ │•MoveMnt │ │•Sharing │  │
│  │•Quotes  │ │•Timeshee│ │•Maint.  │ │•Receive │ │•Serial  │ │•Workflow│  │
│  └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘  │
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────┐   │
│  │                        WORKFLOW ENGINE                               │   │
│  │  Approvals │ State Machines │ Triggers │ Escalations │ SLA          │   │
│  └─────────────────────────────────────────────────────────────────────┘   │
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────┐   │
│  │                        CORE SERVICES                                 │   │
│  │  Auth │ RBAC │ Audit │ Notifications │ Search │ Reports │ API       │   │
│  └─────────────────────────────────────────────────────────────────────┘   │
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────┐   │
│  │                        DATA LAYER                                    │   │
│  │  PostgreSQL/MySQL │ Redis Cache │ Elasticsearch │ File Storage      │   │
│  └─────────────────────────────────────────────────────────────────────┘   │
│                                                                             │
└─────────────────────────────────────────────────────────────────────────────┘
```

---

## 📦 MODÜL HARİTASI

### 1. CRM (Customer Relationship Management)
```
CRM
├── Firmalar (Accounts)
│   ├── Firma bilgileri
│   ├── İletişim geçmişi
│   ├── İlişkili kişiler
│   ├── Satış fırsatları
│   └── Dökümanlar
│
├── Kişiler (Contacts)
│   ├── İletişim bilgileri
│   ├── Firma bağlantısı
│   ├── Roller (karar verici, teknik, satın alma)
│   └── İletişim geçmişi
│
├── Potansiyel Müşteriler (Leads)
│   ├── Lead kaynağı
│   ├── Durum takibi
│   ├── Lead → Fırsat dönüşümü
│   └── Puanlama (scoring)
│
├── Satış Fırsatları (Opportunities)
│   ├── Aşama yönetimi (pipeline)
│   ├── Tahmini tutar
│   ├── Kazanma olasılığı
│   ├── Rakip analizi
│   └── Aktiviteler
│
├── Teklifler (Quotations)
│   ├── Versiyon kontrolü
│   ├── Onay akışı
│   ├── PDF şablonları
│   ├── Teklif → Sipariş dönüşümü
│   └── Revizyon geçmişi
│
└── Siparişler (Sales Orders)
    ├── Sipariş kalemleri
    ├── Teslimat takibi
    ├── Proje bağlantısı
    └── Durum bildirimleri
```

### 2. PROJECT MANAGEMENT
```
PROJECT MANAGEMENT
├── Projeler (Projects)
│   ├── Proje türleri (mühendislik, üretim, kurulum)
│   ├── Proje şablonları
│   ├── Faz/milestone yönetimi
│   ├── Bütçe takibi
│   ├── Risk yönetimi
│   └── Müşteri portalı erişimi
│
├── İş Kırılım Yapısı (WBS)
│   ├── Hiyerarşik görev yapısı
│   ├── Bağımlılıklar
│   ├── Kritik yol analizi
│   └── Gantt görünümü
│
├── Görevler (Tasks)
│   ├── Atama ve takip
│   ├── Zaman kaydı (timesheet)
│   ├── Checklist'ler
│   ├── Alt görevler
│   └── Kanban görünümü
│
├── Kaynak Yönetimi (Resource Planning)
│   ├── Personel kapasite planı
│   ├── Makine/ekipman planı
│   ├── Yük dengeleme
│   └── Çakışma uyarıları
│
├── Zaman Takibi (Timesheets)
│   ├── Günlük/haftalık giriş
│   ├── Proje/görev bazlı
│   ├── Onay akışı
│   └── Raporlama
│
└── Proje Raporları
    ├── İlerleme raporları
    ├── Kaynak kullanımı
    ├── Maliyet analizi
    └── Performans metrikleri
```

### 3. PRODUCTION (MES - Manufacturing Execution)
```
PRODUCTION
├── Ürün Ağacı (BOM - Bill of Materials)
│   ├── Çok seviyeli BOM
│   ├── Phantom BOM
│   ├── Engineering BOM vs Manufacturing BOM
│   ├── Revizyon kontrolü
│   ├── Nereden kullanılıyor (where-used)
│   └── Maliyet hesaplama
│
├── Rotalar (Routings)
│   ├── Operasyon sırası
│   ├── İş merkezi ataması
│   ├── Standart süre
│   ├── Hazırlık süresi
│   └── Alternatif rotalar
│
├── İş Merkezleri (Work Centers)
│   ├── Makine/tezgah tanımları
│   ├── Kapasite tanımları
│   ├── Vardiya planları
│   ├── Maliyet oranları
│   └── Bakım programı
│
├── İş Emirleri (Work Orders)
│   ├── Planlı vs acil üretim
│   ├── Malzeme rezervasyonu
│   ├── Operasyon takibi
│   ├── Gerçekleşen süre kaydı
│   ├── Fire/hurda kaydı
│   └── Kalite kontrol entegrasyonu
│
├── Üretim Planlama (Production Planning)
│   ├── MRP (Material Requirements Planning)
│   ├── Kapasite planlama
│   ├── Çizelgeleme
│   └── Ne-if senaryoları
│
├── Kalite Yönetimi (Quality Control)
│   ├── Muayene planları
│   ├── Kontrol noktaları
│   ├── NCR (Non-Conformance Reports)
│   ├── Düzeltici faaliyetler (CAPA)
│   └── Sertifikalar
│
└── Bakım Yönetimi (Maintenance)
    ├── Periyodik bakım planları
    ├── Arıza bildirimi
    ├── Yedek parça takibi
    └── Bakım geçmişi
```

### 4. SCM (Supply Chain Management)
```
SCM
├── Tedarikçi Yönetimi (Supplier Management)
│   ├── Tedarikçi kartları
│   ├── Performans değerlendirme
│   ├── Sertifikalar/belgeler
│   ├── Fiyat anlaşmaları
│   └── Tedarikçi portalı
│
├── Teklif İsteme (RFQ - Request for Quote)
│   ├── Çoklu tedarikçiye gönderim
│   ├── Teklif karşılaştırma
│   ├── Otomatik hatırlatmalar
│   └── Arşiv
│
├── Satın Alma Talepleri (Purchase Requests)
│   ├── Departman bazlı talepler
│   ├── Onay akışı
│   ├── Bütçe kontrolü
│   └── PR → PO dönüşümü
│
├── Satın Alma Siparişleri (Purchase Orders)
│   ├── Sipariş oluşturma
│   ├── Onay akışı
│   ├── Kısmi teslimat
│   ├── Teslimat takibi
│   └── Tedarikçi performans kaydı
│
├── Mal Kabul (Goods Receipt)
│   ├── PO eşleştirme
│   ├── Kalite kontrol
│   ├── Stok girişi
│   └── Belge yönetimi
│
└── Sözleşmeler (Contracts)
    ├── Çerçeve anlaşmalar
    ├── Fiyat listeleri
    ├── Geçerlilik süreleri
    └── Otomatik yenileme
```

### 5. WMS (Warehouse Management System)
```
WMS
├── Depo Tanımları
│   ├── Çoklu depo desteği
│   ├── Lokasyon yönetimi (raf, bölüm, koridor)
│   ├── Depo tipleri (ana, ara, karantina)
│   └── Depo kapasitesi
│
├── Stok Yönetimi
│   ├── Ürün kartları
│   ├── Lot/parti takibi
│   ├── Seri numara takibi
│   ├── Son kullanma tarihi
│   ├── Minimum/maksimum stok
│   └── Yeniden sipariş noktası
│
├── Stok Hareketleri
│   ├── Giriş (satın alma, üretim, iade)
│   ├── Çıkış (satış, üretim, hurda)
│   ├── Transfer (depo arası)
│   ├── Sayım/düzeltme
│   └── Rezervasyon
│
├── Envanter Kontrol
│   ├── Dönemsel sayım
│   ├── Döngüsel sayım
│   ├── Barkod/RFID entegrasyonu
│   └── Sayım fark raporları
│
├── Stok Raporları
│   ├── Stok değeri
│   ├── Hareket geçmişi
│   ├── ABC analizi
│   ├── Yaşlandırma raporu
│   └── Devir hızı
│
└── Stok Uyarıları
    ├── Düşük stok
    ├── Aşırı stok
    ├── Son kullanma
    └── Ölü stok
```

### 6. DMS (Document Management System)
```
DMS
├── Doküman Yönetimi
│   ├── Hiyerarşik klasör yapısı
│   ├── Versiyon kontrolü
│   ├── Check-in/Check-out
│   ├── Metadata yönetimi
│   └── Tam metin arama
│
├── Doküman Türleri
│   ├── Teknik çizimler (CAD)
│   ├── Teknik şartnameler
│   ├── Prosedürler
│   ├── Formlar
│   ├── Sözleşmeler
│   └── Sertifikalar
│
├── Erişim Kontrolü
│   ├── Rol bazlı erişim
│   ├── Departman bazlı erişim
│   ├── Proje bazlı erişim
│   └── Dış paylaşım (link)
│
├── Entegrasyonlar
│   ├── Proje dosyaları
│   ├── Ürün dosyaları
│   ├── Müşteri dosyaları
│   ├── Tedarikçi dosyaları
│   └── İş emri dosyaları
│
└── Workflow Entegrasyonu
    ├── Doküman onay akışı
    ├── Revizyon onayı
    └── Dağıtım kontrollü
```

### 7. WORKFLOW ENGINE
```
WORKFLOW ENGINE
├── Onay Akışları (Approvals)
│   ├── Satın alma onayı
│   ├── Teklif onayı
│   ├── İş emri onayı
│   ├── Doküman onayı
│   └── İzin/talep onayı
│
├── Durum Makineleri (State Machines)
│   ├── Lead lifecycle
│   ├── Opportunity stages
│   ├── Order fulfillment
│   ├── Production stages
│   └── Project phases
│
├── Tetikleyiciler (Triggers)
│   ├── Alan değişikliği
│   ├── Durum değişikliği
│   ├── Tarih bazlı (scheduled)
│   └── Koşul bazlı
│
├── Aksiyonlar (Actions)
│   ├── Bildirim gönder
│   ├── Görev ata
│   ├── Alan güncelle
│   ├── Kayıt oluştur
│   └── Webhook çağır
│
├── Eskalasyonlar (Escalations)
│   ├── Zaman aşımı
│   ├── Üst yönetici bildirimi
│   └── Otomatik yönlendirme
│
└── SLA Yönetimi
    ├── Yanıt süreleri
    ├── Çözüm süreleri
    └── İhlal bildirimleri
```

---

## 🔐 YETKILENDIRME MATRİSİ

### Rol Hiyerarşisi
```
┌─────────────────────────────────────────┐
│            SYSTEM ADMIN                  │
│  (Tam yetki, sistem ayarları)           │
└────────────────┬────────────────────────┘
                 │
    ┌────────────┼────────────┐
    ▼            ▼            ▼
┌───────┐   ┌───────┐   ┌───────┐
│  CEO  │   │  CFO  │   │  COO  │
│(Tümünü│   │(Finans│   │(Operasy│
│ görür)│   │ odaklı│   │ odaklı)│
└───┬───┘   └───┬───┘   └───┬───┘
    │           │           │
    ▼           ▼           ▼
┌───────────────────────────────┐
│      DEPARTMENT MANAGERS      │
│  (Kendi departmanı + alt)     │
├───────┬───────┬───────┬───────┤
│ Satış │Üretim │Satın  │Proje  │
│ Müd.  │ Müd.  │Alma M.│ Müd.  │
└───┬───┴───┬───┴───┬───┴───┬───┘
    │       │       │       │
    ▼       ▼       ▼       ▼
┌───────────────────────────────┐
│          STAFF/USERS          │
│   (Atanan işler + kısıtlı)    │
└───────────────────────────────┘
```

### Modül Bazlı Yetkiler
| Modül | CEO | Dept.Mgr | Staff | Viewer |
|-------|-----|----------|-------|--------|
| CRM - Tümü | CRUD | CRUD (dept) | CR | R |
| Projects | CRUD | CRUD (own) | RU (assigned) | R |
| Production | CRUD | CRUD | RU | R |
| Purchasing | CRUD | CRU (limit) | CR | R |
| Warehouse | CRUD | CRUD | RU | R |
| Documents | CRUD | CRUD | CR | R |
| Reports | Full | Dept | Limited | - |
| Settings | - | - | - | - |

---

## 📊 DASHBOARD & RAPORLAMA

### Executive Dashboard
```
┌─────────────────────────────────────────────────────────────┐
│                    EXECUTIVE DASHBOARD                       │
├──────────────┬──────────────┬──────────────┬────────────────┤
│  Satış KPI   │  Üretim KPI  │  Stok KPI    │  Proje KPI     │
│  ──────────  │  ──────────  │  ──────────  │  ──────────    │
│  Açık Teklif │  Üretim Hızı │  Stok Değeri │  Aktif Proje   │
│  Pipeline    │  OEE         │  Devir Hızı  │  Tamamlanma %  │
│  Win Rate    │  Kalite      │  Düşük Stok  │  Bütçe Durumu  │
└──────────────┴──────────────┴──────────────┴────────────────┘
│                                                              │
│  ┌────────────────────────┐  ┌────────────────────────────┐ │
│  │  Satış Trendi (Grafik) │  │  Üretim Planı (Gantt)     │ │
│  └────────────────────────┘  └────────────────────────────┘ │
│                                                              │
│  ┌────────────────────────────────────────────────────────┐ │
│  │  Son Aktiviteler / Bildirimler / Onay Bekleyenler      │ │
│  └────────────────────────────────────────────────────────┘ │
└──────────────────────────────────────────────────────────────┘
```

### Standart Raporlar
- Satış: Pipeline, Tahminler, Kazanılan/Kaybedilen
- Üretim: OEE, Üretim Verimliliği, Kalite Oranları
- Stok: Değer, Hareket, ABC Analizi
- Proje: İlerleme, Kaynak Kullanımı, Maliyet
- Satın Alma: Tedarikçi Performans, Harcama Analizi

---

## 🛠️ TEKNİK MİMARİ

### Önerilen Stack (Ölçeklenebilir)
```
┌─────────────────────────────────────────────────────────────┐
│                      FRONTEND                                │
│  Laravel Blade + Livewire + Alpine.js + Tailwind CSS        │
│  (SPA-like experience without full SPA complexity)          │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                      BACKEND                                 │
│  Laravel 11 + Filament Admin Panel                          │
│  (Rapid development, powerful admin UI)                     │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                      DATA LAYER                              │
│  PostgreSQL (primary) + Redis (cache/queue) + S3 (files)   │
└─────────────────────────────────────────────────────────────┘
```

### Neden Filament?
- ✅ Hızlı CRUD geliştirme
- ✅ Güçlü tablo/form bileşenleri
- ✅ İlişki yönetimi
- ✅ Dashboard widget'ları
- ✅ RBAC entegrasyonu
- ✅ Multi-tenancy desteği
- ✅ Aktif topluluk

---

## 📅 GELİŞTİRME ROADMAP

### Faz 1: Core Foundation (4 hafta)
- [ ] Filament kurulumu ve yapılandırma
- [ ] Kullanıcı ve yetki yönetimi
- [ ] Temel ayarlar modülü
- [ ] Bildirim sistemi altyapısı

### Faz 2: CRM (4 hafta)
- [ ] Firmalar ve kişiler
- [ ] Lead yönetimi
- [ ] Fırsat pipeline
- [ ] Teklif sistemi

### Faz 3: Project Management (4 hafta)
- [ ] Proje ve görev yönetimi
- [ ] Gantt chart
- [ ] Kaynak planlama
- [ ] Timesheet

### Faz 4: Production (6 hafta)
- [ ] BOM yönetimi
- [ ] Rota tanımlama
- [ ] İş emirleri
- [ ] Kalite kontrol

### Faz 5: SCM (4 hafta)
- [ ] Tedarikçi yönetimi
- [ ] RFQ ve satın alma
- [ ] Mal kabul

### Faz 6: WMS (3 hafta)
- [ ] Depo ve lokasyon
- [ ] Stok hareketleri
- [ ] Sayım ve raporlar

### Faz 7: DMS & Workflow (3 hafta)
- [ ] Doküman yönetimi
- [ ] Workflow engine
- [ ] Entegrasyonlar

### Faz 8: Reports & Polish (2 hafta)
- [ ] Dashboard'lar
- [ ] Raporlar
- [ ] Test ve optimizasyon

**Toplam: ~30 hafta (7-8 ay)**

---

## ✅ SONRAKI ADIM

Bu mimari onaylanırsa:
1. Filament ile yeni bir proje başlatalım
2. Veritabanı şemasını detaylandıralım
3. Faz 1'e başlayalım

Onay?
