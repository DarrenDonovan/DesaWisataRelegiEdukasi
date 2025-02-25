// database/migrations/xxxx_xx_xx_xxxxxx_create_jenis_kegiatan_table.php
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
        Schema::create('jenis_kegiatan', function (Blueprint $table) {
            $table->id('id_jenis_kegiatan');  
            $table->string('nama_jenis_kegiatan', 100); 
            $table->string('gambar_jenis_kegiatan', 255); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_kegiatan');
    }
};
