<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internal_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_bill_id')->constrained();
            $table->foreignId('sub_property_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->decimal('price', 10, 2);
            $table->enum('payment_status', ['pending', 'paid']);
            $table->string('proof_of_payment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internal_bills');
    }
};
