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
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Contract_No')->nullable()->default(NULL);
            $table->date('Award_Date')->nullable()->default(NULL);
            $table->date('End_Date')->nullable()->default(NULL);
            $table->decimal('Admin_Fee', 3, 2)->nullable()->default(NULL);
            $table->decimal('Discount', 3, 1)->nullable()->default(NULL);
            $table->boolean('Freight_Free');
        });

        Schema::create('coop_effective_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_coop')->constrained(table: 'cooperatives')->onDelete('cascade');
            $table->date('date');
        });

        Schema::create('coop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('Type');
            $table->integer('AEPA_order')->nullable()->default(NULL);
            $table->integer('EI_order')->nullable()->default(NULL);
            $table->integer('OMNIA_order')->nullable()->default(NULL);
            $table->integer('KINETIC_order')->nullable()->default(NULL);
        });

        Schema::create('unit_of_measurements', function (Blueprint $table) {
            $table->id();
            $table->string('UOM');
        });

        Schema::create('coop_aepa_lines', function (Blueprint $table) {
            $table->id();
            $table->string('Line')->nullable()->default(NULL);
            $table->string('Description');
            $table->foreignId('fk_UOM')->constrained(table: 'unit_of_measurements')->nullable()->default(NULL);
            $table->decimal('03_01_2021', 12, 2)->nullable()->default(NULL);
            $table->decimal('03_01_2022', 12, 2)->nullable()->default(NULL);
            $table->decimal('01_01_2023', 12, 2)->nullable()->default(NULL);
            $table->foreignId('fk_category')->constrained(table: 'material_categories');
            $table->boolean('Prepriced');
            $table->boolean('Mutable');
        });

        Schema::create('coop_ei_lines', function (Blueprint $table) {
            $table->id();
            $table->string('Line')->nullable()->default(NULL);
            $table->string('Description');
            $table->foreignId('fk_UOM')->constrained(table: 'unit_of_measurements')->nullable()->default(NULL);
            $table->decimal('03_01_2021', 12, 2)->nullable()->default(NULL);
            $table->decimal('03_01_2022', 12, 2)->nullable()->default(NULL);
            $table->decimal('01_01_2023', 12, 2)->nullable()->default(NULL);
            $table->decimal('08_15_2023', 12, 2)->nullable()->default(NULL);
            $table->foreignId('fk_category')->constrained(table: 'material_categories');
            $table->boolean('Prepriced');
            $table->boolean('Mutable');
        });

        Schema::create('coop_omnia_lines', function (Blueprint $table) {
            $table->id();
            $table->string('Line')->nullable()->default(NULL);
            $table->string('Description');
            $table->foreignId('fk_UOM')->constrained(table: 'unit_of_measurements')->nullable()->default(NULL);
            $table->decimal('03_01_2021', 12, 2)->nullable()->default(NULL);
            $table->decimal('03_01_2022', 12, 2)->nullable()->default(NULL);
            $table->decimal('01_01_2023', 12, 2)->nullable()->default(NULL);
            $table->foreignId('fk_category')->constrained(table: 'material_categories');
            $table->boolean('Prepriced');
            $table->boolean('Mutable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coop_aepa_lines');
        Schema::dropIfExists('coop_ei_lines');
        Schema::dropIfExists('coop_omnia_lines');
        Schema::dropIfExists('coop_effective_dates');
        Schema::dropIfExists('unit_of_measurements');
        Schema::dropIfExists('coop_categories');
        Schema::dropIfExists('cooperatives');
    }
};