<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('mata_kuliahs'))
        {
            Schema::create('mata_kuliahs', function (Blueprint $table) {
                $table->integer('mk_id')->unique('mk_id_UNIQUE');
                $table->integer('mk_ps_id')->index('fk_mataKuliahs_programStudis');
                $table->integer('mk_sm_id')->index('fk_mataKuliahs_semesters');
                $table->integer('mk_sks');
                $table->integer('mk_mutu');
                $table->string('mk_code',12);
                $table->string('mk_name',50);
                $table->string('mk_semester',50);
                $table->string('mk_desc',255)->nullable();
                $table->smallInteger('mk_rec_status');
                $table->string('mk_rec_createdby',150);
                $table->dateTime('mk_rec_created');
                $table->string('mk_rec_updatedby',150)->nullable();
                $table->dateTime('mk_rec_updated')->default(date('Y-m-d H:i:s'));
                $table->string('mk_rec_deletedby',150)->nullable();
                $table->dateTime('mk_rec_deleted')->default(date('Y-m-d H:i:s'));
                $table->primary(['mk_id','mk_ps_id','mk_sm_id']);
                $table->foreign('mk_ps_id')->references('ps_id')->on('program_studis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('mk_sm_id')->references('sm_id')->on('semesters')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('mata_kuliahs');
    }
}
