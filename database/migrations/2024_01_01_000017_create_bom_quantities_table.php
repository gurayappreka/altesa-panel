<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bom_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('bom_items')->cascadeOnDelete();
            $table->foreignId('child_id')->constrained('bom_items')->cascadeOnDelete();
            $table->decimal('quantity', 10, 4)->default(1);
            $table->string('unit', 20)->default('Adet');
            $table->text('notes')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['parent_id', 'child_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bom_quantities');
    }
};
