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
        Schema::create('blood__groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->enum('status', ['0','1'])->default(0)->comment('1 => Active, 0=>InActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood__groups');
    }
};
