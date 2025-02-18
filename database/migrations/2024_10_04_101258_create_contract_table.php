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
        Schema::disableForeignKeyConstraints();

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->datetime('date_start');
            $table->datetime('date_end');
            $table->string('resiliation_delay');
            $table->string('localisation');
            $table->integer('deposit');
            $table->foreignId('box_id')->constrained('boxs');
            $table->foreignId('tenant_id')->constrained('tenants');
            $table->foreignId('model_contract_id')->constrained('contract_models');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};