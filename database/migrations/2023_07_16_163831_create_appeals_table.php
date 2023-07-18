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
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();
            $table->string('TicketId');
            $table->string('licencenumber');
            $table->string('badgenumber');
            $table->string('time');
            $table->string('roomnumber');
            $table->string('status')->default("Ongoing");
            $table->string('verdict')->default("Not Disclosed");
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appeals');
    }
};
