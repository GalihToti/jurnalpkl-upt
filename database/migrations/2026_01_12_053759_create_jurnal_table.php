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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();

            $table->string('no_jurnal')->unique();
            $table->timestamp('waktu')->useCurrent();


            // Relasi ke tabel prakerin
            $table->foreignId('prakerin_id')
                ->constrained('prakerin')
                ->onDelete('cascade');

            $table->date('tanggal');
            $table->text('kegiatan');
            $table->string('tempat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
