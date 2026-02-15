<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Firmalar (Accounts)
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->enum('type', ['customer', 'supplier', 'both'])->default('customer');
            $table->string('tax_office')->nullable();
            $table->string('tax_number', 20)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('Türkiye');
            $table->string('sector')->nullable();
            $table->decimal('credit_limit', 15, 2)->default(0);
            $table->string('currency', 3)->default('TRY');
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // Kişiler (Contacts)
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('department')->nullable();
            $table->enum('role', ['decision_maker', 'technical', 'purchasing', 'finance', 'other'])->default('other');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Departmanlar
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('departments');
            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Kullanıcı departman ilişkisi
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'department_id')) {
                $table->foreignId('department_id')->nullable()->after('id')->constrained();
            }
            if (!Schema::hasColumn('users', 'employee_code')) {
                $table->string('employee_code', 20)->nullable()->after('department_id');
            }
            if (!Schema::hasColumn('users', 'title')) {
                $table->string('title')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('phone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn(['department_id', 'employee_code', 'title', 'phone', 'is_active']);
        });
        Schema::dropIfExists('departments');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('companies');
    }
};
