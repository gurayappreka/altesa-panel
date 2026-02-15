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
│  │   CRM   │ │ PROJECT │ │PRODUCTN │ │   SCM   │ │   WMS   │ │   HRM   │  │
│  │         │ │  MGMT   │ │  (MES)  │ │         │ │         │ │         │  │
│  │•Accounts│ │•Projects│ │•BOM     │ │•Purchase│ │•Stock   │ │•Personel│  │
│  │•Contacts│ │•Tasks   │ │•WorkOrd │ │•Supplier│ │•Warehou │ │•Payroll │  │
│  │•Leads   │ │•Gantt   │ │•Routing │ │•RFQ     │ │•Invntry │ │•Leave   │  │
│  │•Opports │ │•Resource│ │•Quality │ │•Contract│ │•MoveMnt │ │•Recruit │  │
│  │•Quotes  │ │•Timeshee│ │•Maint.  │ │•Receive │ │•Serial  │ │•Training│  │
│  └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘  │
│                                                                             │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐  │
│  │   FMS   │ │   BI    │ │   PLM   │ │   TMS   │ │   DMS   │ │   GRC   │  │
│  │(Finance)│ │(Analitk)│ │ (Ürün)  │ │(Lojistk)│ │         │ │         │  │
│  │•GL/Muhsb│ │•Dashbrd │ │•Lifecycle│ │•Shipment│ │•Files   │ │•Risk    │  │
│  │•AP/AR   │ │•Reports │ │•Revision│ │•Routing │ │•Folders │ │•Complnce│  │
│  │•Budget  │ │•KPIs    │ │•ECR/ECO │ │•Carrier │ │•Version │ │•Audit   │  │
│  │•CostAcct│ │•Forecast│ │•CAD Int.│ │•Track   │ │•Sharing │ │•Policy  │  │
│  │•BankRec │ │•Drill-dn│ │•Where-us│ │•Cost    │ │•Workflow│ │•Incident│  │
│  └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘ └─────────┘  │
│                                                                             │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐                                       │
│  │   FSM   │ │ SERVICE │ │   MDM   │                                       │
│  │ (Saha)  │ │(Destek) │ │(Master) │                                       │
│  │•Install │ │•Tickets │ │•Products│                                       │
│  │•Commissn│ │•Warranty│ │•Customer│                                       │
│  │•Site Vis│ │•SparePrt│ │•Supplier│                                       │
│  │•Crew Pln│ │•Contract│ │•Coding  │                                       │
│  │•Travel  │ │•SLA     │ │•Integrat│                                       │
│  └─────────┘ └─────────┘ └─────────┘                                       │
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────┐   │
│  │                        WORKFLOW ENGINE                               │   │
│  │  Approvals │ State Machines │ Triggers │ Escalations │ SLA          │   │
│  └─────────────────────────────────────────────────────────────────────┘   │
│                                                                             │
│  ┌─────────────────────────────────────────────────────────────────────┐   │
│  │                        CORE SERVICES                                 │   │
│  │  Auth │ RBAC │ Audit │ Notifications │ Search │ Reports │ API       │   │
│  │  Multi-lang │ Multi-currency │ Integration Hub │ Scheduler │ Queue  │   │
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

### 7. HRM (Human Resource Management)
```
HRM
├── Personel Yönetimi
│   ├── Çalışan kartları
│   ├── Organizasyon şeması
│   ├── Pozisyon/ünvan yönetimi
│   ├── İş sözleşmeleri
│   └── Özlük dosyası
│
├── Bordro (Payroll)
│   ├── Maaş hesaplama
│   ├── SGK/vergi kesintileri
│   ├── Ek ödemeler (prim, ikramiye)
│   ├── Bordro raporları
│   └── Banka entegrasyonu
│
├── İzin Yönetimi (Leave)
│   ├── İzin tipleri (yıllık, hastalık, vb.)
│   ├── İzin talep/onay
│   ├── İzin bakiye takibi
│   └── Tatil takvimi
│
├── İşe Alım (Recruitment)
│   ├── Açık pozisyonlar
│   ├── Başvuru takibi
│   ├── Mülakat planlama
│   ├── Aday değerlendirme
│   └── Onboarding süreci
│
├── Eğitim (Training)
│   ├── Eğitim planları
│   ├── Eğitim talepleri
│   ├── Sertifika takibi
│   └── Yetkinlik matrisi
│
├── Performans
│   ├── Hedef belirleme
│   ├── Performans değerlendirme
│   ├── 360° geri bildirim
│   └── Kariyer planlama
│
└── Puantaj
    ├── Giriş/çıkış kaydı
    ├── Fazla mesai takibi
    ├── Vardiya planlama
    └── PDKS entegrasyonu
```

### 8. FMS (Financial Management System)
```
FMS
├── Genel Muhasebe (GL)
│   ├── Hesap planı
│   ├── Muhasebe fişleri
│   ├── Mizan
│   ├── Bilanço
│   └── Gelir tablosu
│
├── Alacak Yönetimi (AR)
│   ├── Müşteri cari hesap
│   ├── Fatura kesimi
│   ├── Tahsilat takibi
│   ├── Vade analizi
│   └── Kredi limiti yönetimi
│
├── Borç Yönetimi (AP)
│   ├── Tedarikçi cari hesap
│   ├── Gelen fatura kaydı
│   ├── Ödeme planlaması
│   ├── Çek/senet yönetimi
│   └── 3-way matching
│
├── Bütçe Yönetimi
│   ├── Bütçe hazırlama
│   ├── Departman bütçeleri
│   ├── Bütçe karşılaştırma
│   └── Revizyon takibi
│
├── Maliyet Muhasebesi
│   ├── Maliyet merkezleri
│   ├── Aktivite bazlı maliyetleme
│   ├── Ürün maliyeti hesaplama
│   └── Sapma analizi
│
├── Banka İşlemleri
│   ├── Banka hesapları
│   ├── Banka mutabakatı
│   ├── Nakit akış takibi
│   └── Döviz yönetimi
│
└── Vergi Yönetimi
    ├── KDV beyanname
    ├── Stopaj hesaplama
    ├── e-Fatura/e-Arşiv
    └── e-Defter entegrasyonu
```

### 9. BI (Business Intelligence)
```
BI
├── Dashboard'lar
│   ├── Executive dashboard
│   ├── Departman dashboard'ları
│   ├── Operasyonel dashboard'lar
│   └── Kişisel dashboard'lar
│
├── Raporlama
│   ├── Standart raporlar
│   ├── Ad-hoc raporlar
│   ├── Çapraz tablolar (pivot)
│   ├── Drill-down/drill-through
│   └── Rapor zamanlama
│
├── KPI Yönetimi
│   ├── KPI tanımlama
│   ├── Hedef belirleme
│   ├── Gerçekleşme takibi
│   ├── Trend analizi
│   └── Scorecard'lar
│
├── Analitik
│   ├── Satış analitiği
│   ├── Üretim analitiği
│   ├── Finansal analitik
│   ├── HR analitiği
│   └── Müşteri analitiği
│
├── Tahminleme (Forecasting)
│   ├── Satış tahmini
│   ├── Talep tahmini
│   ├── Nakit akış tahmini
│   └── What-if senaryoları
│
└── Veri Görselleştirme
    ├── Grafikler (bar, line, pie)
    ├── Haritalar
    ├── Gantt charts
    ├── Sankey diyagramları
    └── Heatmap'ler
```

### 10. PLM (Product Lifecycle Management)
```
PLM
├── Ürün Tanımlama
│   ├── Ürün kartları
│   ├── Ürün kategorileri
│   ├── Ürün özellikleri
│   ├── Varyantlar
│   └── Ürün aileleri
│
├── Yaşam Döngüsü
│   ├── Konsept/fikir
│   ├── Tasarım
│   ├── Prototip
│   ├── Üretime alma
│   ├── Aktif üretim
│   └── End-of-life (EOL)
│
├── Mühendislik Değişiklikleri
│   ├── ECR (Engineering Change Request)
│   ├── ECO (Engineering Change Order)
│   ├── Etki analizi
│   ├── Onay workflow'u
│   └── Effectivity yönetimi
│
├── CAD Entegrasyonu
│   ├── 2D/3D dosya yönetimi
│   ├── Görüntüleme (viewer)
│   ├── BOM otomatik çıkarma
│   └── Revizyon senkronizasyon
│
├── Where-Used Analizi
│   ├── Parça kullanım raporu
│   ├── Etkilenen ürünler
│   └── Maliyet etkisi
│
└── Ürün Konfigürasyonu
    ├── Konfigürasyon kuralları
    ├── Opsiyon yönetimi
    └── Sipariş konfigüratörü
```

### 11. TMS (Transportation Management System)
```
TMS
├── Sevkiyat Yönetimi
│   ├── Sevkiyat planlaması
│   ├── Yük konsolidasyonu
│   ├── Rota optimizasyonu
│   └── Sevk irsaliyesi
│
├── Taşıyıcı Yönetimi
│   ├── Taşıyıcı tanımları
│   ├── Tarife yönetimi
│   ├── Performans takibi
│   └── Sözleşme yönetimi
│
├── Rota Planlama
│   ├── Çoklu durak planı
│   ├── Zaman penceresi
│   ├── Kapasite kontrolü
│   └── GPS entegrasyonu
│
├── Takip (Tracking)
│   ├── Gerçek zamanlı takip
│   ├── ETA hesaplama
│   ├── Gecikme uyarıları
│   └── POD (Proof of Delivery)
│
├── Maliyet Yönetimi
│   ├── Navlun hesaplama
│   ├── Ek masraflar
│   ├── Maliyet karşılaştırma
│   └── Fatura kontrolü
│
└── Gümrük/Dış Ticaret
    ├── Gümrük beyannameleri
    ├── İthalat/ihracat belgeleri
    ├── Menşe şahadetnamesi
    └── Incoterms yönetimi
```

### 12. GRC (Governance, Risk & Compliance)
```
GRC
├── Risk Yönetimi
│   ├── Risk tanımlama
│   ├── Risk değerlendirme (etki x olasılık)
│   ├── Risk haritası
│   ├── Azaltma planları
│   └── Risk izleme
│
├── Uyumluluk (Compliance)
│   ├── Yasal gereksinimler
│   ├── Sektörel standartlar (ISO, vb.)
│   ├── Uyum kontrol listeleri
│   ├── Boşluk analizi
│   └── Düzeltici eylemler
│
├── İç Denetim
│   ├── Denetim planı
│   ├── Denetim bulguları
│   ├── Eylem takibi
│   └── Denetim raporları
│
├── Politika Yönetimi
│   ├── Politika tanımlama
│   ├── Prosedür yönetimi
│   ├── Versiyon kontrolü
│   ├── Dağıtım ve onay
│   └── Okuma takibi
│
├── Olay Yönetimi (Incident)
│   ├── Olay kaydı
│   ├── Kök neden analizi
│   ├── Düzeltici/önleyici faaliyet
│   └── Trend analizi
│
└── Sertifika Yönetimi
    ├── ISO sertifikaları
    ├── Ürün sertifikaları
    ├── Personel sertifikaları
    └── Yenileme takibi
```

### 13. FSM (Field Service Management)
```
FSM
├── Saha Kurulum (Installation)
│   ├── Kurulum projeleri
│   ├── Saha hazırlık checklist
│   ├── Ekipman sevkiyat takibi
│   ├── Kurulum aşamaları
│   └── Müşteri onayları
│
├── Devreye Alma (Commissioning)
│   ├── Commissioning planı
│   ├── Test prosedürleri
│   ├── Parametre ayarları
│   ├── Performans testleri
│   ├── Kabul kriterleri
│   └── FAT/SAT protokolleri
│
├── Saha Ziyaretleri (Site Visits)
│   ├── Ziyaret planlama
│   ├── Ziyaret raporu
│   ├── Fotoğraf/video kayıt
│   ├── Müşteri imzası
│   └── Takip aksiyonları
│
├── Ekip Planlama (Crew Planning)
│   ├── Teknisyen ataması
│   ├── Yetkinlik eşleştirme
│   ├── Takvim yönetimi
│   ├── Çakışma kontrolü
│   └── Mobil erişim
│
├── Seyahat Yönetimi (Travel)
│   ├── Seyahat talebi
│   ├── Uçuş/otel rezervasyon
│   ├── Vize takibi
│   ├── Harcama raporu
│   └── Per diem hesaplama
│
└── Saha Raporları
    ├── Günlük ilerleme
    ├── Problem/çözüm kaydı
    ├── Man-hour takibi
    └── Müşteri memnuniyet
```

### 14. SERVICE (After-Sales / Teknik Destek)
```
SERVICE
├── Destek Talepleri (Tickets)
│   ├── Talep kaydı
│   ├── Önceliklendirme
│   ├── Atama ve yönlendirme
│   ├── Durum takibi
│   └── Çözüm kaydı
│
├── Garanti Yönetimi (Warranty)
│   ├── Garanti tanımları
│   ├── Garanti kapsamı
│   ├── Garanti uzatma
│   ├── Garanti talepleri
│   └── Garanti maliyeti
│
├── Yedek Parça (Spare Parts)
│   ├── Parça kataloğu
│   ├── Fiyat listesi
│   ├── Stok durumu
│   ├── Sipariş takibi
│   └── Kritik parça uyarısı
│
├── Servis Sözleşmeleri (Contracts)
│   ├── Bakım anlaşmaları
│   ├── Destek paketleri
│   ├── Yıllık bakım planı
│   ├── Yenileme takibi
│   └── Gelir takibi
│
├── SLA Yönetimi
│   ├── Yanıt süresi
│   ├── Çözüm süresi
│   ├── Uptime garantisi
│   ├── Ceza/prim hesabı
│   └── SLA raporları
│
└── Uzaktan Destek
    ├── Uzak bağlantı kaydı
    ├── Oturum logları
    ├── Ekran paylaşımı
    └── PLC/HMI erişimi
```

### 15. MDM (Master Data Management)
```
MDM
├── Ürün Ana Verileri
│   ├── Ürün hiyerarşisi
│   ├── Ürün kodlama standardı
│   ├── Ürün özellikleri
│   ├── Birim dönüşümleri
│   └── Veri kalitesi kontrolü
│
├── Müşteri Ana Verileri
│   ├── Müşteri kodlama
│   ├── Adres standardizasyonu
│   ├── İletişim bilgileri
│   ├── Vergi/ticaret bilgileri
│   └── Duplikasyon kontrolü
│
├── Tedarikçi Ana Verileri
│   ├── Tedarikçi kodlama
│   ├── Banka bilgileri
│   ├── Vergi bilgileri
│   └── Onay durumu
│
├── Kodlama Sistemleri
│   ├── Hesap planı
│   ├── Maliyet merkezleri
│   ├── Proje kodları
│   ├── Lokasyon kodları
│   └── Departman kodları
│
└── Entegrasyon Yönetimi
    ├── API yönetimi
    ├── Veri eşitleme
    ├── Hata yönetimi
    ├── Dönüşüm kuralları
    └── Audit trail
```

### 16. WORKFLOW ENGINE (BPM)
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
| HRM | CRUD | CRUD (dept) | R (self) | - |
| Finance | CRUD | CRU (limit) | R | - |
| BI | Full | Dept | Limited | R |
| PLM | CRUD | CRUD | RU | R |
| TMS | CRUD | CRUD | RU | R |
| GRC | CRUD | RU | R | R |
| FSM | CRUD | CRUD | RU (assigned) | R |
| Service | CRUD | CRUD | CRU | R |
| MDM | CRUD | R | R | - |
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

### Faz 8: HRM (4 hafta)
- [ ] Personel yönetimi
- [ ] İzin/puantaj
- [ ] Bordro temeli
- [ ] Eğitim/performans

### Faz 9: FMS - Finance (5 hafta)
- [ ] Genel muhasebe
- [ ] Alacak/borç yönetimi (AR/AP)
- [ ] Bütçe yönetimi
- [ ] Banka mutabakatı
- [ ] e-Fatura entegrasyonu

### Faz 10: PLM (3 hafta)
- [ ] Ürün yaşam döngüsü
- [ ] ECR/ECO workflow
- [ ] CAD entegrasyonu
- [ ] Where-used analizi

### Faz 11: TMS - Logistics (3 hafta)
- [ ] Sevkiyat yönetimi
- [ ] Taşıyıcı/rota planlama
- [ ] Takip ve maliyet
- [ ] Gümrük/dış ticaret

### Faz 12: GRC (2 hafta)
- [ ] Risk yönetimi
- [ ] Uyumluluk kontrolleri
- [ ] Politika/olay yönetimi
- [ ] Denetim

### Faz 13: BI & Analytics (3 hafta)
- [ ] Dashboard framework
- [ ] KPI yönetimi
- [ ] Raporlama motoru
- [ ] Tahminleme araçları

### Faz 14: FSM - Field Service (4 hafta)
- [ ] Saha kurulum yönetimi
- [ ] Devreye alma (commissioning)
- [ ] Ekip planlama
- [ ] Seyahat yönetimi
- [ ] Mobil uygulama (temel)

### Faz 15: Service - After Sales (3 hafta)
- [ ] Destek talep sistemi
- [ ] Garanti yönetimi
- [ ] Yedek parça
- [ ] Servis sözleşmeleri
- [ ] SLA takibi

### Faz 16: MDM & Integration (3 hafta)
- [ ] Ana veri yönetimi
- [ ] Kodlama standartları
- [ ] API gateway
- [ ] Dış sistem entegrasyonları

### Faz 17: Final Polish (3 hafta)
- [ ] Modüller arası entegrasyon testi
- [ ] Performans optimizasyonu
- [ ] UAT ve bug fix
- [ ] Dokümantasyon
- [ ] Eğitim materyalleri

**Toplam: ~55 hafta (13-14 ay)**

---

## ✅ SONRAKI ADIM

Bu mimari onaylanırsa:
1. Filament ile yeni bir proje başlatalım
2. Veritabanı şemasını detaylandıralım
3. Faz 1'e başlayalım

Onay?
