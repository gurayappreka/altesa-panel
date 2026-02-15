#!/bin/bash

echo "🚀 Altesa ERP Kurulum Başlıyor..."

# Composer install
echo "📦 Composer paketleri yükleniyor..."
composer install

# Filament install
echo "🎨 Filament kuruluyor..."
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels

# Environment
echo "⚙️ Environment ayarlanıyor..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Database
echo "🗄️ Veritabanı migrate ediliyor..."
php artisan migrate

# Create admin user
echo "👤 Admin kullanıcı oluşturuluyor..."
php artisan make:filament-user

# NPM
echo "📦 NPM paketleri yükleniyor..."
npm install
npm run build

# Cache
echo "🔄 Cache temizleniyor..."
php artisan optimize:clear
php artisan filament:optimize

echo ""
echo "✅ Kurulum tamamlandı!"
echo ""
echo "🌐 Sunucuyu başlatmak için: php artisan serve"
echo "🔑 Panel erişimi: http://localhost:8000/admin"
echo ""
