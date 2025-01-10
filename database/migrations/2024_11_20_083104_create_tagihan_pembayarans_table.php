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
        Schema::create('tagihan_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('jenis_pembayaran_id');
            $table->enum('status', ['belum_lunas', 'lunas', 'menunggu_konfirmasi'])->default('belum_lunas');
            $table->date('tanggal_pembayaran')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->boolean('verifikasi')->default(false);
            $table->timestamps();
            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jenis_pembayaran_id')->references('id')->on('jenis_pembayarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_pembayarans');
    }
};
