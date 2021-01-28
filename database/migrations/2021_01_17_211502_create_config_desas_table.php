<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigDesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('kode_desa');
            $table->string('nama_kepala_desa');
            $table->string('nip_kepala_desa');
            $table->string('kode_pos');
            $table->string('nama_kecamatan');
            $table->string('kode_kecamatan');
            $table->string('nama_kepala_camat');
            $table->string('nip_kepala_camat');
            $table->string('nama_kabupaten');
            $table->string('kode_kabupaten');
            $table->string('nama_provinsi');
            $table->string('kode_provinsi');
            $table->string('logo')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->string('email_desa')->nullable();
            $table->string('telepon')->nullable();
            $table->string('website')->nullable();
            $table->string('kantor_desa')->nullable();
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
        Schema::dropIfExists('config_desas');
    }
}
