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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->unsignedBigInteger('city_id');
            $table->foreignId('street_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id')->default('1');
            $table->boolean('is_finished')->default(false);
            $table->index('user_id');
            $table->index('status_id');
            $table->index('city_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->unsignedBigInteger("weight")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
