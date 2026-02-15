# Altesa Panel - Sistem Mimarisi

## 🎯 Genel Bakış

Altesa Panel, şirket içi operasyon süreçlerini dijitalleştiren modüler bir yönetim panelidir.

```
┌─────────────────────────────────────────────────────────┐
│                    ALTESA PANEL                         │
├─────────────────────────────────────────────────────────┤
│  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐       │
│  │ Teklif  │ │ Satın   │ │  Depo   │ │  Proje  │       │
│  │ Modülü  │ │ Alma    │ │ Modülü  │ │ Modülü  │       │
│  └────┬────┘ └────┬────┘ └────┬────┘ └────┬────┘       │
│       │           │           │           │             │
│  ┌────┴───────────┴───────────┴───────────┴────┐       │
│  │              CORE SERVICES                   │       │
│  │  ┌────────┐ ┌────────┐ ┌────────┐           │       │
│  │  │ Auth   │ │ File   │ │Activity│           │       │
│  │  │Service │ │Manager │ │ Logger │           │       │
│  │  └────────┘ └────────┘ └────────┘           │       │
│  └──────────────────────────────────────────────┘       │
│                         │                               │
│  ┌──────────────────────┴───────────────────────┐      │
│  │              DATABASE (SQLite)                │      │
│  └───────────────────────────────────────────────┘      │
└─────────────────────────────────────────────────────────┘
```

## 🏗️ Mimari Prensipler

### 1. Modüler Yapı
- Her modül bağımsız çalışabilir
- Modüller arası iletişim servisler üzerinden
- Kolay genişletilebilir

### 2. MVC + Service Layer
```
Request → Controller → Service → Repository → Model → Database
                ↓
            Response ← View (Blade)
```

### 3. Repository Pattern
- Model'ler direkt kullanılmaz
- Repository sınıfları üzerinden veri erişimi
- Test edilebilirlik ve değiştirilebilirlik

## 🔐 Güvenlik Katmanı

```
┌─────────────────────────────────────┐
│           Middleware Stack          │
├─────────────────────────────────────┤
│ 1. CSRF Protection                  │
│ 2. Authentication                   │
│ 3. Authorization (Policies)         │
│ 4. Rate Limiting                    │
│ 5. Input Validation                 │
└─────────────────────────────────────┘
```

## 📱 Frontend Mimarisi

```
┌─────────────────────────────────────┐
│         Blade Templates             │
├─────────────────────────────────────┤
│  layouts/                           │
│  ├── app.blade.php (Ana layout)     │
│  ├── sidebar.blade.php              │
│  └── mobile-nav.blade.php           │
│                                     │
│  components/                        │
│  ├── table.blade.php                │
│  ├── modal.blade.php                │
│  ├── form-*.blade.php               │
│  └── card.blade.php                 │
│                                     │
│  modules/                           │
│  ├── teklifler/                     │
│  ├── satin-alma/                    │
│  ├── depo/                          │
│  ├── projeler/                      │
│  └── dosyalar/                      │
└─────────────────────────────────────┘
```

## 🎨 CSS Framework

**Tailwind CSS** kullanılacak:
- Utility-first yaklaşım
- Mobile-first responsive
- Kolay özelleştirme
- Küçük bundle size

## 📦 Teknoloji Stack

| Katman | Teknoloji |
|--------|-----------|
| Backend | Laravel 11 |
| Frontend | Blade + Alpine.js |
| CSS | Tailwind CSS |
| Database | SQLite |
| Auth | Laravel Breeze |
| Icons | Heroicons |
| PDF | DomPDF |
| File Storage | Local Disk |
