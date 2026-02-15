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

## 📚 Dokümantasyon

- [Sistem Mimarisi](docs/01-ARCHITECTURE.md)
- [Veritabanı Şeması](docs/02-DATABASE-SCHEMA.md)
- [Modül Yapısı](docs/03-MODULE-STRUCTURE.md)
- [Laravel Klasör Yapısı](docs/04-LARAVEL-STRUCTURE.md)
- [Geliştirme Roadmap](docs/05-ROADMAP.md)

## 🚀 Kurulum

```bash
# Repo'yu klonla
git clone https://github.com/gurayappreka/altesa-panel.git
cd altesa-panel

# Bağımlılıkları yükle
composer install
npm install

# Ortam dosyasını ayarla
cp .env.example .env
php artisan key:generate

# Veritabanını oluştur
touch database/database.sqlite
php artisan migrate --seed

# Geliştirme sunucusunu başlat
npm run dev
php artisan serve
```

## 👤 Varsayılan Giriş

- **Email:** admin@altesa.com
- **Şifre:** password

## 📱 Mobil Uyumluluk

Sistem mobile-first yaklaşımla tasarlanmıştır:
- Responsive sidebar (hamburger menu)
- Touch-friendly arayüz
- Mobil uyumlu tablolar

## 📄 Lisans

Private - Altesa Şirketi

---

**Geliştirici:** Koray & AI Assistant  
**Başlangıç:** Şubat 2026
