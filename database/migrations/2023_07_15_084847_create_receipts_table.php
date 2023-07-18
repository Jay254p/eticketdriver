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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->string('transaction_id');
            $table->dateTime('payment_date');
            $table->string('amount');
            $table->string('ticket_id');
            $table->string('driver_name');
            $table->string('driver_phone_number');
            $table->string('driver_email');
            $table->string('driver_id_number');
            $table->string('driver_licence_number');
            $table->string('OffenceCommited');
            $table->string('InspectorBadgeNumber');
            // Add any other receipt details you want to save

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
