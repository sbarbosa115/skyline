<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            // Foreign field does not support default value
            $table->unsignedBigInteger('sub_property_id')->nullable()->default(0);
            $table->foreignId('service_type_id')->constrained();
            $table->date('period_from');
            $table->date('period_to');
            $table->decimal('amount', 10, 2);
            $table->decimal('price', 10, 2);
            $table->enum('payment_status', ['pending', 'paid']);
            $table->timestamps();
            $table->foreign('sub_property_id')->references('id')->on('sub_properties')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_bills');
    }
};
