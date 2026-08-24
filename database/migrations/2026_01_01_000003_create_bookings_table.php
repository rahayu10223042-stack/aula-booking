<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aula_id')->constrained('aulas')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('keperluan');
            $table->unsignedInteger('jumlah_peserta')->nullable();
            $table->string('pic_nama')->nullable();
            $table->string('pic_hp')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled', 'expired'])
                ->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('expires_at')->nullable(); // batas waktu auto-expire kalau pending kelamaan
            $table->timestamps();

            // index buat mempercepat query cek bentrok
            $table->index(['aula_id', 'tanggal', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
