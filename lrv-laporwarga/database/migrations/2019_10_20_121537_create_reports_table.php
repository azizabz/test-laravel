<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->string('foto_laporan', 100);
            $table->string('judul_laporan', 30);
            $table->mediumText('isi_laporan');
            $table->integer('id_kategori')->index();
            $table->bigInteger('id_user')->index();
            $table->enum('status_pelapor', ['Warga Asli', 'Bukan Warga Asli']);
            $table->string('lat', 17);
            $table->string('lon', 16);
            $table->enum('status_laporan', ['lapor', 'periksa', 'valid', 'tidak valid', 'tindaklanjut', 'selesai']);
            $table->date('tgl_kirim');
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
        Schema::dropIfExists('reports');
    }
}
