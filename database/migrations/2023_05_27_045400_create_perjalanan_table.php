<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjalananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_perjalanan', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('petugas', '5');
            $table->string('penerima', '5');
            $table->string('driver', '50');
            $table->date('tanggal');
            $table->string('nopol', '20');
            $table->integer('penumpang');
            $table->string('foto', '100');
            $table->time('pos1')->nullable();
            $table->time('pos9')->nullable();
            $table->string('from');
            $table->softDeletes();
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
        Schema::dropIfExists('tb_perjalanan');
    }
}
