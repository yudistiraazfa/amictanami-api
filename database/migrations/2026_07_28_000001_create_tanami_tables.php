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
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('tanaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_umum');
            $table->string('nama_latin')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar_url')->nullable();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('bibit_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanaman')->cascadeOnDelete();
            $table->string('jenis_bibit')->nullable();
            $table->text('sumber_bibit')->nullable();
            $table->text('jenis_media')->nullable();
            $table->string('rasio_media')->nullable();
            $table->text('drainase')->nullable();
            $table->string('ukuran_pot')->nullable();
            $table->timestamps();
        });

        Schema::create('penyiraman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanaman')->cascadeOnDelete();
            $table->string('frekuensi')->nullable();
            $table->string('waktu_penyiraman')->nullable();
            $table->text('cara_penyiraman')->nullable();
            $table->text('kondisi_khusus')->nullable();
            $table->timestamps();
        });

        Schema::create('pemupukan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanaman')->cascadeOnDelete();
            $table->string('jenis_pupuk')->nullable();
            $table->string('dosis')->nullable();
            $table->string('frekuensi')->nullable();
            $table->text('cara_aplikasi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('perawatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanaman')->cascadeOnDelete();
            $table->string('jenis_perawatan')->nullable();
            $table->string('frekuensi')->nullable();
            $table->text('cara_perawatan')->nullable();
            $table->string('waktu_pelaksanaan')->nullable();
            $table->text('peralatan')->nullable();
            $table->timestamps();
        });

        Schema::create('masa_panen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanaman')->cascadeOnDelete();
            $table->string('durasi_tanam')->nullable();
            $table->text('ciri_siap_panen')->nullable();
            $table->text('cara_panen')->nullable();
            $table->string('frekuensi_panen')->nullable();
            $table->string('hasil_panen')->nullable();
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul');
            $table->string('jam');
            $table->string('tanggal');
            $table->string('tipe');
            $table->timestamps();
        });

        Schema::create('tanamcare_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('date');
            $table->text('explanation');
            $table->text('solution');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanamcare_history');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('masa_panen');
        Schema::dropIfExists('perawatan');
        Schema::dropIfExists('pemupukan');
        Schema::dropIfExists('penyiraman');
        Schema::dropIfExists('bibit_media');
        Schema::dropIfExists('tanaman');
        Schema::dropIfExists('kategori');
    }
};
