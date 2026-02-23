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
        Schema::create('prakerin', function (Blueprint $table) {
            $table->id(); // PK utama
            $table->string('no_pendataan', 10)->unique();

            $table->string('nis', 20)->unique();
            $table->string('nama_siswa', 200);

            $table->foreignId('id_sekolah')
                ->constrained('sekolah', 'id_sekolah')
                ->restrictOnDelete();

            $table->foreignId('id_jurusan')
                ->constrained('jurusan', 'id_jurusan')
                ->restrictOnDelete();

            $table->date('tanggal_mulai_prakerin');
            $table->date('tanggal_akhir_prakerin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prakerin');
    }
};
