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
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang');
        $table->decimal('modal', 10, 2);
        $table->decimal('diskon', 5, 2);
        $table->string('harga_kelas');
        $table->enum('sumber_data', ['train', 'test'])->default('train');
        $table->string('prediksi')->nullable(); 
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
