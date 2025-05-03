<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->unsignedBigInteger('sub_property_id')->nullable()->default(null);
            $table->foreignId('lessor_id')->constrained('users');
            $table->foreignId('lessee_id')->constrained('users');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'inactive']);
            $table->boolean('renew_contract')->nullable();
            $table->timestamps();
            $table->foreign('sub_property_id')->references('id')->on('sub_properties')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
