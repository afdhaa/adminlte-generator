<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonSiswasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nisn');
            $table->text('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->text('tempat_lahir');
            $table->text('anak_ke');
            $table->text('jml_saudara');
            $table->text('hp_siswa');
            $table->text('nik');
            $table->text('alamat');
            $table->text('rt');
            $table->text('rw');
            $table->text('provinsi');
            $table->text('kota');
            $table->text('kecamatan');
            $table->text('desa');
            $table->text('nama_ayah');
            $table->text('pekerjaan_ayah');
            $table->text('nama_ibu');
            $table->text('pekerjaan_ibu');
            $table->text('nama_wali');
            $table->text('pekerjaan_wali');
            $table->text('hp_wali');
            $table->text('asal_smp');
            $table->text('kota_smp');
            $table->integer('mat_s1');
            $table->integer('mat_s2');
            $table->integer('mat_s3');
            $table->integer('mat_s4');
            $table->integer('mat_s5');
            $table->integer('rt_mat');
            $table->integer('inggris_s1');
            $table->integer('inggris_s2');
            $table->integer('inggris_s3');
            $table->integer('inggris_s4');
            $table->integer('inggris_s5');
            $table->integer('rt_inggris');
            $table->integer('indonesia_s1');
            $table->integer('indonesia_s2');
            $table->integer('indonesia_s3');
            $table->integer('indonesia_s4');
            $table->integer('indonesia_s5');
            $table->integer('rt_indonesia');
            $table->integer('ipa_s1');
            $table->integer('ipa_s2');
            $table->integer('ipa_s3');
            $table->integer('ipa_s4');
            $table->integer('ipa_s5');
            $table->integer('rt_ipa');
            $table->integer('ips_s1');
            $table->integer('ips_s2');
            $table->integer('ips_s3');
            $table->integer('ips_s4');
            $table->integer('ips_s5');
            $table->integer('rt_ips');
            $table->text('password');
            $table->text('email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calon_siswas');
    }
}
