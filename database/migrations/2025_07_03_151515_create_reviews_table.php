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
        Schema::create('reviews', function (Blueprint $table) {
   $table->id();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->integer('admin_id')->nullable();
            $table->string('review');
            $table->string('rating');
            $table->boolean('status');
                   $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
