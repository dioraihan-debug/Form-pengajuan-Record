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
        Schema::table('cctv_requests', function (Blueprint $table) {
            $table->string('status_pencarian')->default('pending'); // pending, ditemukan, belum_ditemukan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cctv_requests', function (Blueprint $table) {
            $table->dropColumn('status_pencarian');
        });
    }
};
