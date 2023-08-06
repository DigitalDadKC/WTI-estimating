<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('State');
            $table->string('AEPA_NPW');
            $table->string('AEPA_PW');
            $table->string('EI');
            $table->string('OMNIA');
            $table->timestamps();
        });

        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Contract_No')->nullable();
            $table->date('Award_Date')->nullable();
            $table->date('End_Date')->nullable();
            $table->decimal('Admin_Fee', 3, 2)->nullable();
            $table->decimal('Discount', 3, 1)->nullable();
            $table->boolean('Freight_Free');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};