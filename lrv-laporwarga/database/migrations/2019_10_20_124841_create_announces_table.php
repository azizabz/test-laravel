<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announces', function (Blueprint $table) {
            $table->bigIncrements('id_pgmn');
            $table->string('judul_pgmn', 50);
            $table->mediumText('isi_pgmn');
            $table->bigInteger('id_admin')->index();
            $table->date('tgl_pgmn');
            $table->date('tgl_acara');
            $table->time('mulai_acara');
            $table->time('selesai_acara');
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
        Schema::dropIfExists('announces');
    }
}
