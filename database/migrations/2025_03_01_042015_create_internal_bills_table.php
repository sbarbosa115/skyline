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
        Schema::create('internal_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_property_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_status', ['pendiente', 'pagado']);
            $table->string('proof_of_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_bills');
    }
};
