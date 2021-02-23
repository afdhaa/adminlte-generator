<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTestsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('soal');
            $table->longText('pilihan_a');
            $table->longText('pilihan_b');
            $table->longText('pilihan_c');
            $table->longText('pilihan_d');
            $table->text('jawaban');
            $table->text('image');
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
        Schema::drop('soal_tests');
    }
}
