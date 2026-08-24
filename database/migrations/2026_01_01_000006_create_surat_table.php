<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat');
            $table->unsignedInteger('nomor_urut');
            $table->string('nomor_surat')->unique(); // hasil format lengkap
            $table->date('tanggal_surat');
            $table->string('perihal');
            $table->string('tujuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->string('file_pdf')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
