<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->integer('kategori_id');
            $table->string('nama_properti');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('kota');
            $table->text('gambar_properti');
            $table->double('lat_properti');
            $table->double('long_properti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propertis');
    }
}
