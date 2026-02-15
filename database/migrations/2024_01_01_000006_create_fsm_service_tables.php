<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Saha kurulumları
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->string('installation_no', 30)->unique();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('sales_order_id')->nullable()->constrained();
            $table->foreignId('company_id')->constrained();
            $table->string('site_name');
            $table->text('site_address');
            $table->string('site_city')->nullable();
            $table->string('site_country')->nullable();
            $table->enum('status', ['planning', 'preparation', 'shipping', 'on_site', 'installation', 'commissioning', 'testing', 'completed', 'cancelled'])->default('planning');
            $table->date('planned_start');
            $table->date('planned_end');
            $table->datetime('actual_start')->nullable();
            $table->datetime('actual_end')->nullable();
            $table->foreignId('lead_technician_id')->nullable()->constrained('users');
            $table->text('site_contact_info')->nullable();
            $table->text('prerequisites')->nullable(); // Site hazırlık gereksinimleri
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Kurulum ekibi
        Schema::create('installation_crew', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->enum('role', ['lead', 'technician', 'electrical', 'mechanical', 'software', 'support'])->default('technician');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Commissioning (Devreye Alma)
        Schema::create('commissioning_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installation_id')->constrained()->cascadeOnDelete();
            $table->integer('order');
            $table->string('category'); // FAT, SAT, Safety, Performance, etc.
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('acceptance_criteria')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'passed', 'failed', 'na'])->default('pending');
            $table->datetime('tested_at')->nullable();
            $table->foreignId('tested_by')->nullable()->constrained('users');
            $table->text('result_notes')->nullable();
            $table->timestamps();
        });

        // Saha ziyaretleri
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_no', 30)->unique();
            $table->foreignId('installation_id')->nullable()->constrained();
            $table->foreignId('service_ticket_id')->nullable()->constrained('service_tickets');
            $table->foreignId('company_id')->constrained();
            $table->enum('type', ['installation', 'commissioning', 'maintenance', 'repair', 'inspection', 'training'])->default('maintenance');
            $table->enum('status', ['planned', 'confirmed', 'in_transit', 'on_site', 'completed', 'cancelled'])->default('planned');
            $table->date('planned_date');
            $table->datetime('arrival_time')->nullable();
            $table->datetime('departure_time')->nullable();
            $table->text('objectives')->nullable();
            $table->text('work_performed')->nullable();
            $table->text('findings')->nullable();
            $table->text('recommendations')->nullable();
            $table->boolean('customer_signed')->default(false);
            $table->string('customer_signature_name')->nullable();
            $table->datetime('signed_at')->nullable();
            $table->foreignId('lead_technician_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // Ziyaret ekibi
        Schema::create('site_visit_crew', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_visit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->decimal('hours_worked', 5, 2)->default(0);
            $table->timestamps();
        });

        // Seyahat
        Schema::create('travel_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_no', 30)->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('installation_id')->nullable()->constrained();
            $table->foreignId('site_visit_id')->nullable()->constrained();
            $table->string('destination_city');
            $table->string('destination_country');
            $table->date('departure_date');
            $table->date('return_date');
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected', 'completed', 'cancelled'])->default('draft');
            $table->boolean('needs_flight')->default(true);
            $table->boolean('needs_hotel')->default(true);
            $table->boolean('needs_visa')->default(false);
            $table->string('visa_status')->nullable();
            $table->text('flight_details')->nullable();
            $table->text('hotel_details')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('actual_cost', 10, 2)->nullable();
            $table->string('currency', 3)->default('EUR');
            $table->text('notes')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // Servis talepleri / Destek bileti
        Schema::create('service_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no', 30)->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('contact_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('installation_id')->nullable()->constrained();
            $table->enum('type', ['support', 'breakdown', 'maintenance', 'spare_part', 'training', 'other'])->default('support');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['new', 'assigned', 'in_progress', 'waiting_parts', 'waiting_customer', 'resolved', 'closed', 'cancelled'])->default('new');
            $table->string('subject');
            $table->text('description');
            $table->text('resolution')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->datetime('responded_at')->nullable();
            $table->datetime('resolved_at')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // Servis bileti yorumları
        Schema::create('service_ticket_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->text('content');
            $table->boolean('is_internal')->default(false);
            $table->timestamps();
        });

        // Garanti
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('sales_order_id')->nullable()->constrained();
            $table->foreignId('company_id')->constrained();
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', ['standard', 'extended', 'limited'])->default('standard');
            $table->text('coverage')->nullable();
            $table->text('exclusions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Servis sözleşmeleri
        Schema::create('service_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_no', 30)->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->enum('type', ['maintenance', 'support', 'full_service'])->default('maintenance');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('annual_value', 15, 2)->nullable();
            $table->string('currency', 3)->default('EUR');
            $table->integer('response_time_hours')->default(24);
            $table->integer('resolution_time_hours')->nullable();
            $table->integer('visits_per_year')->nullable();
            $table->text('coverage')->nullable();
            $table->enum('status', ['draft', 'active', 'expired', 'cancelled'])->default('draft');
            $table->boolean('auto_renew')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Yedek parça siparişleri
        Schema::create('spare_part_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 30)->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('service_ticket_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'confirmed', 'preparing', 'shipped', 'delivered', 'cancelled'])->default('draft');
            $table->date('order_date');
            $table->date('required_date')->nullable();
            $table->string('currency', 3)->default('EUR');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->boolean('is_warranty')->default(false);
            $table->text('shipping_address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('spare_part_order_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_part_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->decimal('quantity', 15, 4);
            $table->foreignId('unit_id')->constrained();
            $table->decimal('unit_price', 15, 4);
            $table->decimal('line_total', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spare_part_order_lines');
        Schema::dropIfExists('spare_part_orders');
        Schema::dropIfExists('service_contracts');
        Schema::dropIfExists('warranties');
        Schema::dropIfExists('service_ticket_comments');
        Schema::dropIfExists('service_tickets');
        Schema::dropIfExists('travel_requests');
        Schema::dropIfExists('site_visit_crew');
        Schema::dropIfExists('site_visits');
        Schema::dropIfExists('commissioning_tasks');
        Schema::dropIfExists('installation_crew');
        Schema::dropIfExists('installations');
    }
};
