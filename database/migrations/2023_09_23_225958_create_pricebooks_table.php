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
        Schema::create('material_unit_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('Unit_Size');
            $table->timestamps();
        });

        Schema::create('material_categories', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->timestamps();
        });

        Schema::create('material_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('Status');
            $table->timestamps();
        });

        Schema::create('pricebook_effective_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_coop')->nullable()->default(NULL)->constrained(table: 'cooperatives')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('pricebooks', function (Blueprint $table) {
            $table->id();
            $table->string('SKU');
            $table->string('Name');
            $table->foreignId('fk_unit_size')->constrained(table: 'material_unit_sizes');
            $table->decimal('PB_FY24_1', 10, 2)->nullable()->default(NULL);
            $table->enum('PB_FY24_1_Status', ['New', 'Active', 'Removed', 'Obsolete'])->nullable();
            $table->foreignId('PB_FY24_1_Status_2')->nullable()->constrained(table: 'material_statuses');
            $table->decimal('PB_FY23_3', 10, 2)->nullable()->default(NULL);
            $table->enum('PB_FY23_3_Status', ['New', 'Active', 'Removed', 'Obsolete'])->nullable();
            $table->foreignId('PB_FY23_3_Status_2')->nullable()->constrained(table: 'material_statuses');
            $table->boolean('Discountable');
            $table->foreignId('fk_category')->constrained(table: 'material_categories');
            $table->decimal('SQPerPallet', 4, 2)->nullable()->default(NULL);
            $table->integer('SF')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricebooks');
        Schema::dropIfExists('pricebook_effective_dates');
        Schema::dropIfExists('material_statuses');
        Schema::dropIfExists('material_categories');
        Schema::dropIfExists('material_unit_sizes');
    }
};