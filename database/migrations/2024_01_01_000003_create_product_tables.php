<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ürün kategorileri
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('product_categories');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Birimler
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->string('symbol', 10)->nullable();
            $table->timestamps();
        });

        // Ürünler
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('product_categories');
            $table->enum('type', ['raw_material', 'semi_finished', 'finished', 'service', 'consumable'])->default('raw_material');
            $table->foreignId('unit_id')->constrained();
            $table->decimal('unit_price', 15, 4)->default(0);
            $table->string('currency', 3)->default('TRY');
            $table->decimal('min_stock', 15, 4)->default(0);
            $table->decimal('max_stock', 15, 4)->nullable();
            $table->decimal('reorder_point', 15, 4)->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('is_purchasable')->default(true);
            $table->boolean('is_sellable')->default(false);
            $table->boolean('is_manufactured')->default(false);
            $table->boolean('track_serial')->default(false);
            $table->boolean('track_lot')->default(false);
            $table->integer('lead_time_days')->nullable();
            $table->enum('lifecycle', ['concept', 'design', 'prototype', 'production', 'eol'])->default('production');
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // BOM (Ürün Ağacı)
        Schema::create('boms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('revision', 10)->default('A');
            $table->string('name')->nullable();
            $table->enum('type', ['engineering', 'manufacturing'])->default('manufacturing');
            $table->enum('status', ['draft', 'active', 'obsolete'])->default('draft');
            $table->date('effective_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['product_id', 'revision']);
        });

        // BOM satırları
        Schema::create('bom_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bom_id')->constrained()->cascadeOnDelete();
            $table->integer('line_no');
            $table->foreignId('component_id')->constrained('products');
            $table->decimal('quantity', 15, 6);
            $table->foreignId('unit_id')->constrained();
            $table->enum('type', ['standard', 'phantom', 'optional'])->default('standard');
            $table->decimal('scrap_percent', 5, 2)->default(0);
            $table->string('position')->nullable(); // Pozisyon/referans
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // İş merkezleri
        Schema::create('work_centers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['machine', 'assembly', 'manual', 'external'])->default('machine');
            $table->decimal('hourly_rate', 10, 2)->default(0);
            $table->decimal('capacity_hours', 5, 2)->default(8); // Günlük kapasite
            $table->integer('efficiency_percent')->default(100);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Rotalar
        Schema::create('routings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('revision', 10)->default('A');
            $table->enum('status', ['draft', 'active', 'obsolete'])->default('draft');
            $table->timestamps();

            $table->unique(['product_id', 'revision']);
        });

        // Rota operasyonları
        Schema::create('routing_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routing_id')->constrained()->cascadeOnDelete();
            $table->integer('operation_no');
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('work_center_id')->constrained();
            $table->decimal('setup_time', 8, 2)->default(0); // dakika
            $table->decimal('run_time', 8, 2)->default(0); // dakika/birim
            $table->decimal('wait_time', 8, 2)->default(0);
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routing_operations');
        Schema::dropIfExists('routings');
        Schema::dropIfExists('work_centers');
        Schema::dropIfExists('bom_lines');
        Schema::dropIfExists('boms');
        Schema::dropIfExists('products');
        Schema::dropIfExists('units');
        Schema::dropIfExists('product_categories');
    }
};
