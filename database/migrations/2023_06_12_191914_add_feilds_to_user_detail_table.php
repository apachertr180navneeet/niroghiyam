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
        Schema::table('user_detail', function (Blueprint $table) {
            $table->date('date_of_birth');
            $table->string('pincode', 255);
            $table->enum('gender', ['0','1','2'])->default(0)->comment('1 => male', '0=>female', '2=>trangender');
            $table->unsignedBigInteger('blood_group');
            $table->unsignedBigInteger('allergy');
            $table->enum('vecination', ['0','1'])->default(0)->comment('1 => yes', '0=>no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_detail', function (Blueprint $table) {
            //
        });
    }
};
