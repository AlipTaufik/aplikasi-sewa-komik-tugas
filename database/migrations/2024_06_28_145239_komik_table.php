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
        Schema::create('komik', function (Blueprint $table) {
            $table->id();
            $table->string('kode_komik',10)->unique();
            $table->string('nama_komik',255);
            $table->double('harga');
            $table->string('genre',255);
            $table->string('image')->nullable();
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
