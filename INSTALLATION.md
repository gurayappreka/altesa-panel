# Altesa Panel - Kurulum Kılavuzu

## ⚠️ ÖNEMLİ NOTLAR

Bu proje **sandbox ortamında** geliştirilmiştir ve aşağıdaki araçlarla çalıştırılması gerekir:

- **PHP >= 8.2**
- **Composer**
- **Node.js & npm**
- **SQLite**

## 📦 Host Sistemde Kurulum

### 1. Bağımlılıkları Yükle

```bash
cd /Users/guray/.clawdbot/sandboxes/agent-koray-a1cbae09/altesa-panel

# PHP bağımlılıklarını yükle
composer install

# Node.js bağımlılıklarını yükle
npm install
```

### 2. Veritabanını Hazırla

```bash
# SQLite dosyasını oluştur
touch database/database.sqlite

# Migration'ları çalıştır
php artisan migrate --seed
```

### 3. Uygulama Anahtarını Oluştur

```bash
php artisan key:generate
```

### 4. Storage Link'i Oluştur

```bash
php artisan storage:link
```

### 5. Assets'leri Derle

```bash
# Development için
npm run dev

# Production için
npm run build
```

### 6. Sunucuyu Başlat

**İki terminal açın:**

Terminal 1 (Vite dev server):
```bash
npm run dev
```

Terminal 2 (Laravel server):
```bash
php artisan serve
```

Tarayıcınızda `http://localhost:8000` adresine gidin.

## 👤 Giriş Bilgileri

| Rol | E-posta | Şifre |
|-----|---------|-------|
| Admin | admin@altesa.com | password |
| Manager | manager@altesa.com | password |
| Staff | staff@altesa.com | password |

## ✅ Doğrulama

Kurulumun başarılı olduğunu doğrulamak için:

1. `http://localhost:8000` adresine gidin
2. `admin@altesa.com` / `password` ile giriş yapın
3. Dashboard'u görüyor olmalısınız
4. Menüden "Müşteriler" sayfasına gidin
5. "Yeni Müşteri" butonuna tıklayın
6. Form açılıyor mu kontrol edin

## 🐛 Sorun Giderme

### "Class not found" hatası

```bash
composer dump-autoload
```

### Migration hatası

```bash
php artisan migrate:fresh --seed
```

### Asset yüklenmiyor

```bash
npm run build
php artisan config:clear
php artisan cache:clear
```

### Permission hatası

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## 🔄 GitHub'a Push

Proje şu anda local bir klasörde. GitHub'a pushlayabilmek için:

```bash
cd /Users/guray/.clawdbot/sandboxes/agent-koray-a1cbae09/altesa-panel

# Mevcut remote'u kontrol et
git remote -v

# Eğer remote yoksa ekle
git remote add origin https://github.com/gurayappreka/altesa-panel.git

# Develop branch'i oluştur ve push et
git checkout -b develop
git add .
git commit -m "Initial Laravel 11 setup with all modules"
git push -u origin develop
```

## 📝 Yapılandırma

### .env Dosyası

Önemli ayarlar:

```env
APP_NAME="Altesa Panel"
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite

COMPANY_NAME="Altesa"
COMPANY_EMAIL="info@altesa.com"
```

### Tailwind CSS

Renkler ve stilleri özelleştirmek için `tailwind.config.js` dosyasını düzenleyin.

## 🎉 Tamamlandı!

Proje artık kullanıma hazır. Dashboard'da:
- 6 istatistik kartı
- Son teklifler
- Görevlerim
- Düşük stok uyarıları

görmelisiniz.

---

**Geliştirici:** Koray AI Assistant  
**Tarih:** {{ date('Y-m-d') }}
