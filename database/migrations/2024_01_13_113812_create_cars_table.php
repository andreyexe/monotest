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
        Schema::create('cars', function (Blueprint $table) {
            $table->id()->index();
            $table->string('car_brand');
            $table->string('model');
            $table->string('color');
            $table->string('state_number')->unique();
            $table->boolean('is_set');
            $table->unsignedBigInteger('client_id')->nullable()->unsigned();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
