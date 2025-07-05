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
        Schema::create('maintainances', function (Blueprint $table) {
            $table->id();
            $table->text('secret_key'); // Added secret_key to store a unique key for maintainance mode
            $table->enum('mode', ['on', 'off'])->default('off'); 
            $table->text('down_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintainances');
    }
};
