<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('kelas'))
        {
            Schema::create('kelas', function (Blueprint $table) {
                $table->integer('kls_id')->unique('kls_id_UNIQUE');
                $table->string('kls_code',20);
                $table->string('kls_name',40);
                $table->smallInteger('kls_capacity');
                $table->smallInteger('kls_mhs_count');
                $table->string('kls_desc',255)->nullable();
                $table->primary('kls_id');
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_bin';
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
