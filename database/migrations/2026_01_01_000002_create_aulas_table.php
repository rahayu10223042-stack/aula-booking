<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // wiradadaha, wiratanuningrat, wirahadiningrat
            $table->string('nama');
            $table->unsignedInteger('kapasitas')->nullable();
            $table->text('fasilitas')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
