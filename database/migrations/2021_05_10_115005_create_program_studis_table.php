<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramStudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('program_studis'))
        {
            Schema::create('program_studis', function (Blueprint $table) {
                $table->integer('ps_id')->unique('ps_id_UNIQUE');
                $table->integer('ps_fks_id');
                $table->string('ps_name',100);
                $table->string('ps_desc',255)->nullable();
                $table->smallInteger('ps_rec_status');
                $table->string('ps_rec_createdby',150);
                $table->dateTime('ps_rec_created');
                $table->string('ps_rec_updatedby',150)->nullable();
                $table->dateTime('ps_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('ps_rec_deletedby',150)->nullable();
                $table->dateTime('ps_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary(['ps_id','ps_fks_id']);
                $table->foreign('ps_fks_id', 'fk_programStudis_fakultas')->references('fks_id')->on('fakultas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('program_studis');
    }
}
