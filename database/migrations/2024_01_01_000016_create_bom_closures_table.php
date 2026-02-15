<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bom_closures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ancestor_id')->constrained('bom_items')->cascadeOnDelete();
            $table->foreignId('descendant_id')->constrained('bom_items')->cascadeOnDelete();
            $table->integer('depth')->default(0);
            $table->unique(['ancestor_id', 'descendant_id']);
            
            $table->index('ancestor_id');
            $table->index('descendant_id');
            $table->index('depth');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bom_closures');
    }
};
