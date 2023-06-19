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
        Schema::create('user_kyc', function (Blueprint $table) {
            $table->id('user_kyc_id');
            $table->unsignedBigInteger('user_id');
            $table->string('kyc_image', 255);
            $table->string('kyc_detail', 255);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kyc');
    }
};
