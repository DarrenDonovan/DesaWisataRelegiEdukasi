// database/migrations/xxxx_xx_xx_xxxxxx_create_kegiatan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan'); 
            $table->string('nama_kegiatan', 255);  
            $table->text('keterangan');  
            $table->string('gambar_kegiatan', 255);  
            $table->foreignId('id_jenis_kegiatan')  
                ->constrained('jenis_kegiatan') 
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
}
