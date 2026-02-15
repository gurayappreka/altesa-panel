<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bom_items', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20); // project, subproject, product, assembly, part, equipment
            $table->string('code', 50)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('bom_items')->nullOnDelete();
            $table->integer('level')->default(0);
            $table->string('source_type', 20)->nullable(); // manufacture, purchase, stock
            $table->string('unit', 20)->default('Adet');
            $table->decimal('unit_cost', 15, 2)->nullable();
            $table->integer('lead_time_days')->nullable();
            $table->string('drawing_number', 50)->nullable();
            $table->string('revision', 10)->nullable();
            $table->decimal('weight', 10, 3)->nullable();
            $table->string('material', 100)->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->string('status', 20)->default('active');
            $table->boolean('is_template')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bom_items');
    }
};
