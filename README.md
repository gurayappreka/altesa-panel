# 🏢 Altesa Panel

Altesa şirketi için modüler web yönetim paneli.

## 📋 Proje Özeti

| Özellik | Değer |
|---------|-------|
| **Backend** | Laravel 11 |
| **Frontend** | Blade + Alpine.js |
| **CSS** | Tailwind CSS |
| **Database** | SQLite |
| **Dil** | Türkçe |

## 🎯 Modüller

1. **Teklif Modülü** - Teklif oluşturma, PDF çıktısı, durum takibi
2. **Satın Alma Modülü** - Tedarikçi yönetimi, sipariş takibi
3. **Depo/Stok Modülü** - Ürün tanımlama, stok giriş/çıkış
4. **Proje Modülü** - Proje ve görev yönetimi
5. **Dosya Modülü** - FTP benzeri dosya paylaşımı
6. **Kullanıcı Yönetimi** - Rol bazlı yetkilendirme
7. **BOM Modülü** - Ürün ağaçları (Bill of Materials)

## 📚 Dokümantasyon

- [Sistem Mimarisi](docs/01-ARCHITECTURE.md)
- [Veritabanı Şeması](docs/02-DATABASE-SCHEMA.md)
- [Modül Yapısı](docs/03-MODULE-STRUCTURE.md)
- [Laravel Klasör Yapısı](docs/04-LARAVEL-STRUCTURE.md)
- [Geliştirme Roadmap](docs/05-ROADMAP.md)
- [BOM Modülü](docs/06-BOM-MODULE.md)

## 🚀 Kurulum

### Gereksinimler

- PHP >= 8.2
- Composer
- Node.js & npm
- SQLite

### Kurulum Adımları

```bash
# Bağımlılıkları yükle
composer install
npm install

# Veritabanını oluştur
touch database/database.sqlite

# Ortam değişkenlerini ayarla
cp .env.example .env
php artisan key:generate

# Veritabanını migrate et ve seed et
php artisan migrate --seed

# Assets'leri derle
npm run build

# Geliştirme sunucusunu başlat (2 terminal)
npm run dev
php artisan serve
```

## 👤 Varsayılan Giriş Bilgileri

| Rol | E-posta | Şifre |
|-----|---------|-------|
| **Admin** | admin@altesa.com | password |
| **Manager** | manager@altesa.com | password |
| **Staff** | staff@altesa.com | password |

## 📱 Özellikler

### ✅ Tamamlanan

- [x] Laravel 11 kurulumu
- [x] SQLite veritabanı yapılandırması
- [x] Tailwind CSS + Alpine.js entegrasyonu
- [x] Authentication sistemi
- [x] Tüm migration'lar
- [x] Model ilişkileri
- [x] CRUD controller'ları
- [x] Responsive UI (mobile-first)
- [x] Dashboard
- [x] Müşteri yönetimi
- [x] Teklif yönetimi
- [x] Tedarikçi yönetimi
- [x] Satın alma yönetimi
- [x] Ürün/Stok yönetimi
- [x] Proje yönetimi
- [x] Görev yönetimi
- [x] Dosya yönetimi
- [x] Kullanıcı yönetimi
- [x] Rol bazlı yetkilendirme
- [x] BOM (Bill of Materials) modülü

### 🚧 Gelecek Güncellemeler

- [ ] PDF teklif çıktısı
- [ ] Excel export
- [ ] Gelişmiş filtreleme
- [ ] Bildirim sistemi
- [ ] Activity log görüntüleme
- [ ] Dashboard grafikleri

## 📱 Mobil Uyumluluk

Sistem mobile-first yaklaşımla tasarlanmıştır:
- ✅ Responsive sidebar (hamburger menu)
- ✅ Touch-friendly arayüz
- ✅ Mobil uyumlu tablolar
- ✅ Responsive grid layout

## 🔒 Güvenlik

- CSRF koruması
- SQL injection koruması
- XSS koruması
- Rol tabanlı erişim kontrolü
- Şifre hash'leme

## 📄 Lisans

Private - Altesa Şirketi

---

**Geliştirici:** Koray AI Assistant  
**Tarih:** Şubat 2026  
**Versiyon:** 1.0.0

## 🆘 Destek

Sorun bildirmek veya öneride bulunmak için GitHub Issues kullanın.
