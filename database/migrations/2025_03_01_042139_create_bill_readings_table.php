<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bill_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_property_id')->constrained();
            $table->decimal('reading_value', 10, 2);
            $table->date('reading_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bill_readings');
    }
};
