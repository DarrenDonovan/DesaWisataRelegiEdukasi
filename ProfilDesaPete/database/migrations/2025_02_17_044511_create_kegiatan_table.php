// database/migrations/xxxx_xx_xx_xxxxxx_create_kegiatan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('id_wilayah')
                ->constrained('wilayah')
                ->onDelete('cascade');
            $table->date('tanggal_kegiatan');
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
;