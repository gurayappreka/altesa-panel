<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Satın alma talepleri
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_no', 30)->unique();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected', 'ordered', 'cancelled'])->default('draft');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->date('required_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('requested_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->datetime('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('purchase_request_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained()->cascadeOnDelete();
            $table->integer('line_no');
            $table->foreignId('product_id')->constrained();
            $table->decimal('quantity', 15, 4);
            $table->foreignId('unit_id')->constrained();
            $table->date('required_date')->nullable();
            $table->text('specification')->nullable();
            $table->timestamps();
        });

        // Teklif isteği (RFQ)
        Schema::create('rfqs', function (Blueprint $table) {
            $table->id();
            $table->string('rfq_no', 30)->unique();
            $table->foreignId('purchase_request_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'sent', 'received', 'evaluated', 'closed', 'cancelled'])->default('draft');
            $table->date('deadline')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rfq_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfq_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained();
            $table->datetime('sent_at')->nullable();
            $table->datetime('received_at')->nullable();
            $table->enum('status', ['pending', 'sent', 'received', 'selected', 'rejected'])->default('pending');
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->string('currency', 3)->default('TRY');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Satın alma siparişleri
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 30)->unique();
            $table->foreignId('company_id')->constrained(); // Tedarikçi
            $table->foreignId('contact_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('rfq_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'pending_approval', 'approved', 'sent', 'partial', 'received', 'cancelled'])->default('draft');
            $table->date('order_date');
            $table->date('expected_date')->nullable();
            $table->string('currency', 3)->default('TRY');
            $table->decimal('exchange_rate', 10, 4)->default(1);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->enum('payment_terms', ['cash', 'cod', 'net15', 'net30', 'net45', 'net60'])->default('net30');
            $table->text('shipping_address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();
            $table->integer('line_no');
            $table->foreignId('product_id')->constrained();
            $table->text('description')->nullable();
            $table->decimal('quantity', 15, 4);
            $table->decimal('received_qty', 15, 4)->default(0);
            $table->foreignId('unit_id')->constrained();
            $table->decimal('unit_price', 15, 4);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('tax_percent', 5, 2)->default(20);
            $table->decimal('line_total', 15, 2)->default(0);
            $table->date('expected_date')->nullable();
            $table->enum('status', ['pending', 'partial', 'received', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // Mal kabul
        Schema::create('goods_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_no', 30)->unique();
            $table->foreignId('purchase_order_id')->constrained();
            $table->foreignId('warehouse_id')->constrained();
            $table->date('receipt_date');
            $table->string('delivery_note')->nullable();
            $table->enum('status', ['draft', 'received', 'inspected', 'completed', 'rejected'])->default('draft');
            $table->text('notes')->nullable();
            $table->foreignId('received_by')->constrained('users');
            $table->timestamps();
        });

        Schema::create('goods_receipt_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_receipt_id')->constrained()->cascadeOnDelete();
            $table->foreignId('purchase_order_line_id')->constrained('purchase_order_lines');
            $table->foreignId('product_id')->constrained();
            $table->decimal('quantity', 15, 4);
            $table->decimal('accepted_qty', 15, 4)->default(0);
            $table->decimal('rejected_qty', 15, 4)->default(0);
            $table->foreignId('unit_id')->constrained();
            $table->foreignId('location_id')->nullable()->constrained('warehouse_locations');
            $table->string('lot_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Satış teklifleri
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_no', 30)->unique();
            $table->string('revision', 5)->default('1');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('contact_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'sent', 'negotiating', 'won', 'lost', 'expired', 'cancelled'])->default('draft');
            $table->date('quotation_date');
            $table->date('valid_until')->nullable();
            $table->string('currency', 3)->default('EUR');
            $table->decimal('exchange_rate', 10, 4)->default(1);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->integer('delivery_weeks')->nullable();
            $table->enum('payment_terms', ['advance', 'cod', 'net30', 'milestone'])->default('milestone');
            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();
            $table->integer('win_probability')->default(50); // 0-100
            $table->string('lost_reason')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['quotation_no', 'revision']);
        });

        Schema::create('quotation_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained()->cascadeOnDelete();
            $table->integer('line_no');
            $table->foreignId('product_id')->nullable()->constrained();
            $table->text('description');
            $table->decimal('quantity', 15, 4)->default(1);
            $table->foreignId('unit_id')->nullable()->constrained();
            $table->decimal('unit_price', 15, 4);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('tax_percent', 5, 2)->default(20);
            $table->decimal('line_total', 15, 2)->default(0);
            $table->timestamps();
        });

        // Satış siparişleri
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 30)->unique();
            $table->foreignId('quotation_id')->nullable()->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('contact_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'confirmed', 'in_progress', 'partial', 'delivered', 'invoiced', 'cancelled'])->default('draft');
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->string('currency', 3)->default('EUR');
            $table->decimal('exchange_rate', 10, 4)->default(1);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->text('shipping_address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sales_order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->constrained()->cascadeOnDelete();
            $table->integer('line_no');
            $table->foreignId('product_id')->nullable()->constrained();
            $table->text('description');
            $table->decimal('quantity', 15, 4);
            $table->decimal('delivered_qty', 15, 4)->default(0);
            $table->foreignId('unit_id')->nullable()->constrained();
            $table->decimal('unit_price', 15, 4);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('tax_percent', 5, 2)->default(20);
            $table->decimal('line_total', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_order_lines');
        Schema::dropIfExists('sales_orders');
        Schema::dropIfExists('quotation_lines');
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('goods_receipt_lines');
        Schema::dropIfExists('goods_receipts');
        Schema::dropIfExists('purchase_order_lines');
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('rfq_suppliers');
        Schema::dropIfExists('rfqs');
        Schema::dropIfExists('purchase_request_lines');
        Schema::dropIfExists('purchase_requests');
    }
};
