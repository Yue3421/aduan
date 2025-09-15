<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasTable extends Migration
{
    public function up()
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('nama_petugas', 25);
            $table->string('username', 25)->unique();
            $table->string('password'); // Bcrypt, tanpa batas panjang
            $table->string('telp', 13);
            $table->enum('level', ['admin', 'petugas'])->default('petugas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas');
    }
}