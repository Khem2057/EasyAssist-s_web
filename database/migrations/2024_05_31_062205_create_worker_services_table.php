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
        Schema::create('worker_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobile_user_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            $table->foreign('mobile_user_id')->references('id')->on('mobile_users');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_services');
    }
};
