<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Depolar
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->enum('type', ['main', 'transit', 'quarantine', 'scrap'])->default('main');
            $table->text('address')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Depo lokasyonları
        Schema::create('warehouse_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->string('code', 30);
            $table->string('name')->nullable();
            $table->string('aisle')->nullable();
            $table->string('rack')->nullable();
            $table->string('shelf')->nullable();
            $table->string('bin')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['warehouse_id', 'code']);
        });

        // Stok
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('warehouse_id')->constrained();
            $table->foreignId('location_id')->nullable()->constrained('warehouse_locations');
            $table->string('lot_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->decimal('quantity', 15, 4)->default(0);
            $table->decimal('reserved_qty', 15, 4)->default(0);
            $table->decimal('available_qty', 15, 4)->storedAs('quantity - reserved_qty');
            $table->date('expiry_date')->nullable();
            $table->decimal('unit_cost', 15, 4)->default(0);
            $table->timestamps();

            $table->index(['product_id', 'warehouse_id']);
        });

        // Stok hareketleri
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('document_no', 30);
            $table->enum('type', ['in', 'out', 'transfer', 'adjustment']);
            $table->enum('source', ['purchase', 'production', 'sales', 'return', 'transfer', 'adjustment', 'scrap']);
            $table->foreignId('product_id')->constrained();
            $table->foreignId('from_warehouse_id')->nullable()->constrained('warehouses');
            $table->foreignId('to_warehouse_id')->nullable()->constrained('warehouses');
            $table->foreignId('from_location_id')->nullable()->constrained('warehouse_locations');
            $table->foreignId('to_location_id')->nullable()->constrained('warehouse_locations');
            $table->decimal('quantity', 15, 4);
            $table->foreignId('unit_id')->constrained();
            $table->decimal('unit_cost', 15, 4)->default(0);
            $table->string('lot_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('reference_type')->nullable(); // purchase_order, work_order, etc.
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['product_id', 'created_at']);
            $table->index(['reference_type', 'reference_id']);
        });

        // İş emirleri
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 30)->unique();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('bom_id')->nullable()->constrained();
            $table->foreignId('routing_id')->nullable()->constrained();
            $table->decimal('quantity', 15, 4);
            $table->decimal('completed_qty', 15, 4)->default(0);
            $table->decimal('scrap_qty', 15, 4)->default(0);
            $table->foreignId('unit_id')->constrained();
            $table->enum('status', ['draft', 'planned', 'released', 'in_progress', 'completed', 'cancelled'])->default('draft');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->date('planned_start');
            $table->date('planned_end');
            $table->datetime('actual_start')->nullable();
            $table->datetime('actual_end')->nullable();
            $table->foreignId('warehouse_id')->constrained();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // İş emri operasyonları
        Schema::create('work_order_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_order_id')->constrained()->cascadeOnDelete();
            $table->integer('operation_no');
            $table->string('name');
            $table->foreignId('work_center_id')->constrained();
            $table->decimal('planned_hours', 8, 2)->default(0);
            $table->decimal('actual_hours', 8, 2)->default(0);
            $table->enum('status', ['pending', 'in_progress', 'completed', 'skipped'])->default('pending');
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->foreignId('operator_id')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // İş emri malzeme rezervasyonları
        Schema::create('work_order_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->decimal('required_qty', 15, 4);
            $table->decimal('reserved_qty', 15, 4)->default(0);
            $table->decimal('issued_qty', 15, 4)->default(0);
            $table->foreignId('unit_id')->constrained();
            $table->foreignId('warehouse_id')->constrained();
            $table->enum('status', ['pending', 'partial', 'issued'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_order_materials');
        Schema::dropIfExists('work_order_operations');
        Schema::dropIfExists('work_orders');
        Schema::dropIfExists('stock_movements');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('warehouse_locations');
        Schema::dropIfExists('warehouses');
    }
};
