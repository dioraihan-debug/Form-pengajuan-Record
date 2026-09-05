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
        Schema::create('cctv_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klien');
            $table->string('no_ktp');
            $table->string('no_hp');
            $table->text('alamat');
            $table->date('tanggal_kejadian');
            $table->time('waktu_kejadian');
            $table->string('posisi_cctv');
            $table->text('alasan_kronologi');
            $table->string('foto_ktp')->nullable();
            $table->string('nomor_formulir')->default('F/D-0508/45');
            $table->date('tanggal_formulir');
            $table->enum('status_keputusan', ['pending', 'diijinkan', 'ditolak'])->default('pending');
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cctv_requests');
    }
};
