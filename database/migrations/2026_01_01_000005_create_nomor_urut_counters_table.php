<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nomor_urut_counters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_klasifikasi');
            $table->unsignedInteger('tahun');
            $table->unsignedInteger('last_number')->default(0);
            $table->timestamps();

            // satu counter unik per kombinasi kode klasifikasi + tahun
            $table->unique(['kode_klasifikasi', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nomor_urut_counters');
    }
};
