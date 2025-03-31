<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->foreignId('service_type_id')->constrained();
            $table->string('name');
            $table->boolean('is_shared'); // only if property has sub properties
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties_services');
    }
};
