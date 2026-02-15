<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bom_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bom_item_id')->constrained('bom_items')->cascadeOnDelete();
            $table->string('file_type', 20); // drawing, document, image, other
            $table->string('file_name');
            $table->string('file_path', 500);
            $table->unsignedBigInteger('file_size')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bom_attachments');
    }
};
