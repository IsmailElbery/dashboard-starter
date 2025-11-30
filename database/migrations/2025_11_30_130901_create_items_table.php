<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Text input
            $table->string('email')->nullable(); // Email input
            $table->text('description')->nullable(); // Textarea
            $table->decimal('price', 10, 2)->default(0); // Number input (decimal)
            $table->integer('quantity')->default(0); // Number input (integer)
            $table->date('manufacturing_date')->nullable(); // Date picker
            $table->dateTime('expiry_date')->nullable(); // DateTime picker
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending'); // Select dropdown
            $table->enum('category', ['electronics', 'clothing', 'food', 'books', 'other'])->default('other'); // Select dropdown
            $table->enum('type', ['type_a', 'type_b', 'type_c'])->default('type_a'); // Radio buttons
            $table->boolean('is_featured')->default(false); // Single checkbox
            $table->boolean('is_available')->default(true); // Single checkbox
            $table->json('features')->nullable(); // Multiple checkboxes (stored as JSON)
            $table->string('image')->nullable(); // File upload (image)
            $table->string('document')->nullable(); // File upload (document)
            $table->string('color')->nullable(); // Color picker
            $table->string('url')->nullable(); // URL input
            $table->text('notes')->nullable(); // Textarea for additional notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
