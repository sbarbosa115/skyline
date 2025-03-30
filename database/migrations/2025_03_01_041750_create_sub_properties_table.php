<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_properties', function (Blueprint $table) {
            $table->id();
            $table->string('unit_number');
            $table->foreignId('property_id')->constrained();
            $table->foreignId('landlord_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_properties');
    }
};
