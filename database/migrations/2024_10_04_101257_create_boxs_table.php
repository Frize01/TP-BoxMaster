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

        Schema::create('boxs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('address', 255);
            $table->bigInteger('surface');
            $table->bigInteger('volume');
            $table->bigInteger('default_price');
            $table->integer('default_deposit');
            $table->bigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxs');
    }
};
