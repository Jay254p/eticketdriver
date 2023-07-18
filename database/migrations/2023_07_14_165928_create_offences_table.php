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
        Schema::create('offences', function (Blueprint $table) {
            $table->id();
            $table->string('TicketId')->unique();;
            $table->string('DriverName');
            $table->string('DriverLicenceNumber');
            $table->string('DriverCarRegNo');
            $table->string('DriverPhoneNumber');
            $table->string('OffenceCommited');
            $table->string('PlaceOfOffence');
            $table->string('InspectorBadgeNumber');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offences');
    }
};
