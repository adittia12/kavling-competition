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
        Schema::create('transaction_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kavling');
            $table->unsignedBigInteger('id_direction');
            $table->unsignedBigInteger('id_parameter');
            $table->bigInteger('value');
            $table->timestamps();

            $table->foreign('id_kavling')->references('id')->onDelete('cascade')->onUpdate('cascade')->on('kavling');
            $table->foreign('id_direction')->references('id')->onDelete('cascade')->onUpdate('cascade')->on('directors');
            $table->foreign('id_parameter')->references('id')->onDelete('cascade')->onUpdate('cascade')->on('value_parameter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_value');
    }
};
