<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Peminjaman Aula, Undangan, Nota Dinas, dst
            $table->string('kode_klasifikasi'); // 005, 800, dst
            $table->boolean('generate_pdf_otomatis')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_surat');
    }
};
