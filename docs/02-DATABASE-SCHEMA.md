# Altesa Panel - Veritabanı Şeması

## 📊 ER Diyagramı (Basitleştirilmiş)

```
┌──────────────┐       ┌──────────────┐       ┌──────────────┐
│    users     │       │   customers  │       │  suppliers   │
├──────────────┤       ├──────────────┤       ├──────────────┤
│ id           │       │ id           │       │ id           │
│ name         │       │ name         │       │ name         │
│ email        │       │ company      │       │ company      │
│ password     │       │ phone        │       │ phone        │
│ role         │       │ email        │       │ email        │
│ is_active    │       │ address      │       │ address      │
└──────┬───────┘       └──────┬───────┘       └──────┬───────┘
       │                      │                      │
       │    ┌─────────────────┼──────────────────────┤
       │    │                 │                      │
       ▼    ▼                 ▼                      ▼
┌──────────────┐       ┌──────────────┐       ┌──────────────┐
│   quotes     │       │   projects   │       │  purchases   │
├──────────────┤       ├──────────────┤       ├──────────────┤
│ id           │       │ id           │       │ id           │
│ customer_id  │──────▶│ customer_id  │       │ supplier_id  │
│ user_id      │       │ name         │       │ user_id      │
│ quote_no     │       │ status       │       │ purchase_no  │
│ status       │       │ start_date   │       │ status       │
│ total        │       │ end_date     │       │ total        │
│ valid_until  │       │ description  │       │ notes        │
└──────┬───────┘       └──────┬───────┘       └──────┬───────┘
       │                      │                      │
       ▼                      ▼                      ▼
┌──────────────┐       ┌──────────────┐       ┌──────────────┐
│ quote_items  │       │    tasks     │       │purchase_items│
├──────────────┤       ├──────────────┤       ├──────────────┤
│ id           │       │ id           │       │ id           │
│ quote_id     │       │ project_id   │       │ purchase_id  │
│ product_id   │       │ title        │       │ product_id   │
│ quantity     │       │ status       │       │ quantity     │
│ unit_price   │       │ assigned_to  │       │ unit_price   │
│ total        │       │ due_date     │       │ total        │
└──────────────┘       └──────────────┘       └──────────────┘

┌──────────────┐       ┌──────────────┐       ┌──────────────┐
│   products   │       │stock_movemnts│       │    files     │
├──────────────┤       ├──────────────┤       ├──────────────┤
│ id           │       │ id           │       │ id           │
│ name         │◀──────│ product_id   │       │ name         │
│ sku          │       │ type (in/out)│       │ path         │
│ unit         │       │ quantity     │       │ folder_id    │
│ stock_qty    │       │ reference    │       │ fileable_type│
│ min_stock    │       │ user_id      │       │ fileable_id  │
│ supplier_id  │       │ notes        │       │ uploaded_by  │
└──────────────┘       └──────────────┘       └──────────────┘
```

## 📋 Tablo Detayları

### 1. users (Kullanıcılar)
```sql
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'staff') DEFAULT 'staff',
    avatar VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT 1,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 2. customers (Müşteriler)
```sql
CREATE TABLE customers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    company VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(50) NULL,
    address TEXT NULL,
    tax_number VARCHAR(50) NULL,
    tax_office VARCHAR(100) NULL,
    notes TEXT NULL,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 3. suppliers (Tedarikçiler)
```sql
CREATE TABLE suppliers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    company VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(50) NULL,
    address TEXT NULL,
    tax_number VARCHAR(50) NULL,
    tax_office VARCHAR(100) NULL,
    notes TEXT NULL,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 4. quotes (Teklifler)
```sql
CREATE TABLE quotes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quote_no VARCHAR(50) UNIQUE NOT NULL,
    customer_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    status ENUM('draft', 'sent', 'approved', 'rejected') DEFAULT 'draft',
    subtotal DECIMAL(15,2) DEFAULT 0,
    tax_rate DECIMAL(5,2) DEFAULT 18,
    tax_amount DECIMAL(15,2) DEFAULT 0,
    total DECIMAL(15,2) DEFAULT 0,
    valid_until DATE NULL,
    notes TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 5. quote_items (Teklif Kalemleri)
```sql
CREATE TABLE quote_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quote_id INTEGER NOT NULL,
    product_id INTEGER NULL,
    description VARCHAR(255) NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    unit VARCHAR(20) DEFAULT 'Adet',
    unit_price DECIMAL(15,2) NOT NULL,
    total DECIMAL(15,2) NOT NULL,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (quote_id) REFERENCES quotes(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### 6. purchases (Satın Alma Talepleri)
```sql
CREATE TABLE purchases (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    purchase_no VARCHAR(50) UNIQUE NOT NULL,
    supplier_id INTEGER NULL,
    user_id INTEGER NOT NULL,
    status ENUM('pending', 'ordered', 'delivered', 'cancelled') DEFAULT 'pending',
    total DECIMAL(15,2) DEFAULT 0,
    expected_date DATE NULL,
    delivered_date DATE NULL,
    notes TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 7. purchase_items (Satın Alma Kalemleri)
```sql
CREATE TABLE purchase_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    purchase_id INTEGER NOT NULL,
    product_id INTEGER NULL,
    description VARCHAR(255) NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    unit VARCHAR(20) DEFAULT 'Adet',
    unit_price DECIMAL(15,2) NULL,
    total DECIMAL(15,2) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (purchase_id) REFERENCES purchases(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### 8. products (Ürünler/Stok)
```sql
CREATE TABLE products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    sku VARCHAR(100) UNIQUE NULL,
    description TEXT NULL,
    unit VARCHAR(20) DEFAULT 'Adet',
    stock_quantity DECIMAL(10,2) DEFAULT 0,
    min_stock_level DECIMAL(10,2) DEFAULT 0,
    supplier_id INTEGER NULL,
    location VARCHAR(100) NULL,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);
```

### 9. stock_movements (Stok Hareketleri)
```sql
CREATE TABLE stock_movements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_id INTEGER NOT NULL,
    type ENUM('in', 'out') NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    reference_type VARCHAR(50) NULL,
    reference_id INTEGER NULL,
    user_id INTEGER NOT NULL,
    notes TEXT NULL,
    created_at TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 10. projects (Projeler)
```sql
CREATE TABLE projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    customer_id INTEGER NULL,
    status ENUM('planning', 'active', 'on_hold', 'completed', 'cancelled') DEFAULT 'planning',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    start_date DATE NULL,
    end_date DATE NULL,
    description TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);
```

### 11. tasks (Görevler)
```sql
CREATE TABLE tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    project_id INTEGER NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status ENUM('todo', 'in_progress', 'done') DEFAULT 'todo',
    assigned_to INTEGER NULL,
    due_date DATE NULL,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);
```

### 12. folders (Klasörler)
```sql
CREATE TABLE folders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    parent_id INTEGER NULL,
    folderable_type VARCHAR(50) NULL,
    folderable_id INTEGER NULL,
    created_by INTEGER NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES folders(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

### 13. files (Dosyalar)
```sql
CREATE TABLE files (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    path VARCHAR(500) NOT NULL,
    mime_type VARCHAR(100) NULL,
    size INTEGER NULL,
    folder_id INTEGER NULL,
    fileable_type VARCHAR(50) NULL,
    fileable_id INTEGER NULL,
    uploaded_by INTEGER NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (folder_id) REFERENCES folders(id),
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);
```

### 14. activity_logs (İşlem Logları)
```sql
CREATE TABLE activity_logs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NULL,
    loggable_type VARCHAR(50) NOT NULL,
    loggable_id INTEGER NOT NULL,
    action VARCHAR(50) NOT NULL,
    old_values TEXT NULL,
    new_values TEXT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 15. permissions (Yetkiler)
```sql
CREATE TABLE permissions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    role VARCHAR(50) NOT NULL,
    module VARCHAR(50) NOT NULL,
    can_view BOOLEAN DEFAULT 0,
    can_create BOOLEAN DEFAULT 0,
    can_edit BOOLEAN DEFAULT 0,
    can_delete BOOLEAN DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(role, module)
);
```

## 🔗 İlişki Özeti

| Tablo | İlişki | Tablo |
|-------|--------|-------|
| users | 1:N | quotes |
| users | 1:N | purchases |
| users | 1:N | tasks (assigned) |
| customers | 1:N | quotes |
| customers | 1:N | projects |
| suppliers | 1:N | products |
| suppliers | 1:N | purchases |
| quotes | 1:N | quote_items |
| purchases | 1:N | purchase_items |
| products | 1:N | stock_movements |
| projects | 1:N | tasks |
| folders | 1:N | files |
| * | N:N | files (polymorphic) |
