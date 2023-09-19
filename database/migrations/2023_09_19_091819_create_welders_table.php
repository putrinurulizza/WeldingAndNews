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
        Schema::create('welders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pemilik');
            $table->integer('jumlah_pekerja');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('kota');
            $table->text('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welders');
    }
};
