<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_property_id')->constrained();
            $table->date('period_from');
            $table->date('period_to');
            $table->decimal('amount', 10, 2);
            $table->decimal('price', 10, 2);
            $table->enum('payment_status', ['generated', 'sent', 'paid'])->default('generated');
            $table->string('image_payment_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
