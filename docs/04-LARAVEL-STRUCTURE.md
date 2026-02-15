# Altesa Panel - Laravel Klasör Yapısı

## 📁 Proje Yapısı

```
altesa-panel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── ForgotPasswordController.php
│   │   │   ├── CustomerController.php
│   │   │   ├── QuoteController.php
│   │   │   ├── SupplierController.php
│   │   │   ├── PurchaseController.php
│   │   │   ├── ProductController.php
│   │   │   ├── StockController.php
│   │   │   ├── ProjectController.php
│   │   │   ├── TaskController.php
│   │   │   ├── FileController.php
│   │   │   ├── FolderController.php
│   │   │   ├── UserController.php
│   │   │   ├── SettingController.php
│   │   │   ├── ProfileController.php
│   │   │   └── DashboardController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── CheckRole.php
│   │   │   └── CheckModuleAccess.php
│   │   │
│   │   └── Requests/
│   │       ├── CustomerRequest.php
│   │       ├── QuoteRequest.php
│   │       ├── SupplierRequest.php
│   │       ├── PurchaseRequest.php
│   │       ├── ProductRequest.php
│   │       ├── ProjectRequest.php
│   │       ├── TaskRequest.php
│   │       └── UserRequest.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Customer.php
│   │   ├── Supplier.php
│   │   ├── Quote.php
│   │   ├── QuoteItem.php
│   │   ├── Purchase.php
│   │   ├── PurchaseItem.php
│   │   ├── Product.php
│   │   ├── StockMovement.php
│   │   ├── Project.php
│   │   ├── Task.php
│   │   ├── Folder.php
│   │   ├── File.php
│   │   ├── ActivityLog.php
│   │   ├── Permission.php
│   │   └── Setting.php
│   │
│   ├── Services/
│   │   ├── QuoteService.php
│   │   ├── PurchaseService.php
│   │   ├── StockService.php
│   │   ├── FileService.php
│   │   ├── PdfService.php
│   │   └── ActivityLogService.php
│   │
│   ├── Repositories/
│   │   ├── BaseRepository.php
│   │   ├── CustomerRepository.php
│   │   ├── QuoteRepository.php
│   │   ├── SupplierRepository.php
│   │   ├── PurchaseRepository.php
│   │   ├── ProductRepository.php
│   │   ├── ProjectRepository.php
│   │   └── FileRepository.php
│   │
│   ├── Policies/
│   │   ├── CustomerPolicy.php
│   │   ├── QuotePolicy.php
│   │   ├── PurchasePolicy.php
│   │   ├── ProductPolicy.php
│   │   ├── ProjectPolicy.php
│   │   └── FilePolicy.php
│   │
│   ├── Observers/
│   │   └── ActivityLogObserver.php
│   │
│   ├── Traits/
│   │   ├── HasActivityLog.php
│   │   └── GeneratesNumber.php
│   │
│   └── Helpers/
│       └── helpers.php
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── altesa.php (özel ayarlar)
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 2024_01_01_000001_create_customers_table.php
│   │   ├── 2024_01_01_000002_create_suppliers_table.php
│   │   ├── 2024_01_01_000003_create_products_table.php
│   │   ├── 2024_01_01_000004_create_quotes_table.php
│   │   ├── 2024_01_01_000005_create_quote_items_table.php
│   │   ├── 2024_01_01_000006_create_purchases_table.php
│   │   ├── 2024_01_01_000007_create_purchase_items_table.php
│   │   ├── 2024_01_01_000008_create_stock_movements_table.php
│   │   ├── 2024_01_01_000009_create_projects_table.php
│   │   ├── 2024_01_01_000010_create_tasks_table.php
│   │   ├── 2024_01_01_000011_create_folders_table.php
│   │   ├── 2024_01_01_000012_create_files_table.php
│   │   ├── 2024_01_01_000013_create_activity_logs_table.php
│   │   ├── 2024_01_01_000014_create_permissions_table.php
│   │   └── 2024_01_01_000015_create_settings_table.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── PermissionSeeder.php
│       └── SettingSeeder.php
│
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── uploads/ (dosya yüklemeleri - .gitignore'da)
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── guest.blade.php
│   │   │   └── partials/
│   │   │       ├── sidebar.blade.php
│   │   │       ├── header.blade.php
│   │   │       ├── mobile-nav.blade.php
│   │   │       └── footer.blade.php
│   │   │
│   │   ├── components/
│   │   │   ├── alert.blade.php
│   │   │   ├── badge.blade.php
│   │   │   ├── button.blade.php
│   │   │   ├── card.blade.php
│   │   │   ├── dropdown.blade.php
│   │   │   ├── modal.blade.php
│   │   │   ├── table.blade.php
│   │   │   ├── form/
│   │   │   │   ├── input.blade.php
│   │   │   │   ├── select.blade.php
│   │   │   │   ├── textarea.blade.php
│   │   │   │   └── checkbox.blade.php
│   │   │   └── pagination.blade.php
│   │   │
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── forgot-password.blade.php
│   │   │   └── reset-password.blade.php
│   │   │
│   │   ├── dashboard/
│   │   │   └── index.blade.php
│   │   │
│   │   ├── customers/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── edit.blade.php
│   │   │
│   │   ├── quotes/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── pdf.blade.php
│   │   │
│   │   ├── suppliers/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── edit.blade.php
│   │   │
│   │   ├── purchases/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── receive.blade.php
│   │   │
│   │   ├── products/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── movements.blade.php
│   │   │
│   │   ├── stock/
│   │   │   ├── in.blade.php
│   │   │   ├── out.blade.php
│   │   │   └── alerts.blade.php
│   │   │
│   │   ├── projects/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── edit.blade.php
│   │   │
│   │   ├── tasks/
│   │   │   ├── index.blade.php
│   │   │   └── my-tasks.blade.php
│   │   │
│   │   ├── files/
│   │   │   └── index.blade.php
│   │   │
│   │   ├── users/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   │
│   │   ├── settings/
│   │   │   ├── general.blade.php
│   │   │   ├── company.blade.php
│   │   │   └── permissions.blade.php
│   │   │
│   │   ├── profile/
│   │   │   └── edit.blade.php
│   │   │
│   │   └── logs/
│   │       └── index.blade.php
│   │
│   ├── css/
│   │   └── app.css
│   │
│   └── js/
│       └── app.js
│
├── routes/
│   ├── web.php
│   └── auth.php
│
├── storage/
│   ├── app/
│   │   └── uploads/ (dosya yüklemeleri)
│   └── ...
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

## 📄 Örnek Dosya İçerikleri

### routes/web.php
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\*;

// Public
Route::get('/', fn() => redirect('/login'));

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [Auth\LoginController::class, 'create'])->name('login');
    Route::post('/login', [Auth\LoginController::class, 'store']);
});

// Protected
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [Auth\LoginController::class, 'destroy'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Customers
    Route::resource('customers', CustomerController::class);
    
    // Quotes
    Route::resource('quotes', QuoteController::class);
    Route::get('/quotes/{quote}/pdf', [QuoteController::class, 'pdf'])->name('quotes.pdf');
    Route::post('/quotes/{quote}/duplicate', [QuoteController::class, 'duplicate'])->name('quotes.duplicate');
    
    // Suppliers
    Route::resource('suppliers', SupplierController::class);
    
    // Purchases
    Route::resource('purchases', PurchaseController::class);
    Route::get('/purchases/{purchase}/receive', [PurchaseController::class, 'receive'])->name('purchases.receive');
    Route::post('/purchases/{purchase}/receive', [PurchaseController::class, 'storeReceive']);
    
    // Products
    Route::resource('products', ProductController::class);
    Route::get('/products/{product}/movements', [ProductController::class, 'movements'])->name('products.movements');
    
    // Stock
    Route::get('/stock/in', [StockController::class, 'createIn'])->name('stock.in');
    Route::post('/stock/in', [StockController::class, 'storeIn']);
    Route::get('/stock/out', [StockController::class, 'createOut'])->name('stock.out');
    Route::post('/stock/out', [StockController::class, 'storeOut']);
    Route::get('/stock/alerts', [StockController::class, 'alerts'])->name('stock.alerts');
    
    // Projects
    Route::resource('projects', ProjectController::class);
    
    // Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my');
    Route::resource('projects.tasks', TaskController::class)->shallow();
    
    // Files
    Route::get('/files/{folder?}', [FileController::class, 'index'])->name('files.index');
    Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::get('/files/download/{file}', [FileController::class, 'download'])->name('files.download');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
    
    // Folders
    Route::resource('folders', FolderController::class)->except(['index', 'show']);
    
    // Admin Only
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
    });
    
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
        Route::get('/settings/company', [SettingController::class, 'company'])->name('settings.company');
        Route::get('/settings/permissions', [SettingController::class, 'permissions'])->name('settings.permissions');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
```

### config/altesa.php
```php
<?php

return [
    'company' => [
        'name' => env('COMPANY_NAME', 'Altesa'),
        'address' => env('COMPANY_ADDRESS', ''),
        'phone' => env('COMPANY_PHONE', ''),
        'email' => env('COMPANY_EMAIL', ''),
        'tax_number' => env('COMPANY_TAX_NUMBER', ''),
        'tax_office' => env('COMPANY_TAX_OFFICE', ''),
    ],
    
    'formats' => [
        'quote_prefix' => 'TKL',
        'quote_digits' => 5,
        'purchase_prefix' => 'SIP',
        'purchase_digits' => 5,
    ],
    
    'uploads' => [
        'max_size' => 10 * 1024, // 10MB in KB
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', 'txt', 'csv'],
    ],
    
    'pagination' => [
        'per_page' => 15,
    ],
];
```
