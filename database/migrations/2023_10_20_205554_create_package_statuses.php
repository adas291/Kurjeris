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
        Schema::create('package_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('status_id');
            $table->unique(['status_id','package_id']);
            $table->index('package_id');
            $table->index('status_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_statuses');
    }
};
