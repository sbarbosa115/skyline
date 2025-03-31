<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shared_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properties_service_id')->constrained();
            $table->foreignId('sub_property_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {                                             
        Schema::dropIfExists('shared_services');
    }
};
