# 🚀 Altesa ERP - Hızlı Başlangıç

## Gereksinimler
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+ veya PostgreSQL 14+

## 1. Kurulum (5 dakika)

```bash
# Proje dizinine git
cd altesa-panel

# Bağımlılıkları yükle
composer install

# Filament kur
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels

# .env düzenle
cp .env.example .env
php artisan key:generate

# Veritabanı ayarla (.env içinde)
# DB_CONNECTION=mysql
# DB_DATABASE=altesa_erp
# DB_USERNAME=root
# DB_PASSWORD=

# Migration çalıştır
php artisan migrate

# Admin kullanıcı oluştur
php artisan make:filament-user

# Assets derle
npm install
npm run build

# Sunucuyu başlat
php artisan serve
```

## 2. Erişim

- Panel: http://localhost:8000/admin
- Login: Oluşturduğun kullanıcı

## 3. Mevcut Tablolar

### Core
- [x] companies (Firmalar)
- [x] contacts (Kişiler)  
- [x] departments (Departmanlar)
- [x] users (Kullanıcılar)

### Projects
- [x] projects (Projeler)
- [x] project_phases (Fazlar)
- [x] tasks (Görevler)
- [x] time_entries (Zaman Kayıtları)

### Products & Manufacturing
- [x] product_categories
- [x] units
- [x] products (Ürünler)
- [x] boms (Ürün Ağacı)
- [x] bom_lines
- [x] work_centers (İş Merkezleri)
- [x] routings (Rotalar)
- [x] routing_operations

### Inventory
- [x] warehouses (Depolar)
- [x] warehouse_locations
- [x] stocks (Stok)
- [x] stock_movements
- [x] work_orders (İş Emirleri)
- [x] work_order_operations
- [x] work_order_materials

### Purchasing
- [x] purchase_requests
- [x] rfqs
- [x] purchase_orders
- [x] goods_receipts

### Sales
- [x] quotations (Teklifler)
- [x] sales_orders (Siparişler)

### FSM (Field Service)
- [x] installations (Kurulumlar)
- [x] installation_crew
- [x] commissioning_tasks
- [x] site_visits
- [x] travel_requests

### Service
- [x] service_tickets
- [x] warranties
- [x] service_contracts
- [x] spare_part_orders

## 4. Sonraki Adımlar

1. `php artisan make:filament-resource Company --generate` ile Resource oluştur
2. Her modül için Resource ekle
3. Dashboard widget'ları ekle

---

**Toplam: 40+ tablo hazır** 🎉
