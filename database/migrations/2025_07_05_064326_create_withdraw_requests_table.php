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
        Schema::create('withdraw_requests', function (Blueprint $table) {
          $table->id();
            $table->integer('vendor_id');
            $table->string('method');
            $table->double('total_earnings')->nullable(); // Added total_earnings to store vendor's total earnings
            $table->double('withdraw_amount');
            $table->double('withdraw_charge');
            $table->double('current_balance')->nullable(); // Added final_amount to store the amount after deducting charges
            $table->text('account_info');
            $table->enum('status', ['pending', 'paid', 'decline']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_requests');
    }
};
