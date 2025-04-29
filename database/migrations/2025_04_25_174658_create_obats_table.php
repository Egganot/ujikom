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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('NmObat');
            $table->string('Jenis');
            $table->string('Satuan');
            $table->integer('HargaBeli');
            $table->integer('HargaJual');
            $table->integer('Stok');
            $table->date('Kadaluarsa');
            $table->foreignId('KdSupplier')->constrained('suppliers')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
