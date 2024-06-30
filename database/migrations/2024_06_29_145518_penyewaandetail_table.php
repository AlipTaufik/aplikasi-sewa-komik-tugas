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
        Schema::create('penyewaandetail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyewaan_id');
            $table->string('kode_komik');
            $table->date('tanggal_sewa');
            $table->date('tanggal_dikembalikan');
            $table->double('harga', 15, 2);
            $table->integer('qty');
            $table->double('subtotal', 15, 2);

            // Foreign key constraints
            $table->foreign('penyewaan_id')->references('id')->on('penyewaan')->onDelete('cascade');
            $table->foreign('kode_komik')->references('kode_komik')->on('komik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
