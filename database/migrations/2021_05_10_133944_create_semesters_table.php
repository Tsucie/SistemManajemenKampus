<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('semesters'))
        {
            Schema::create('semesters', function (Blueprint $table) {
                $table->integer('sm_id')->unique('sm_id_UNIQUE');
                $table->string('sm_name',50);
                $table->string('sm_code',20);
                $table->integer('sm_val');
                $table->string('sm_desc',255)->nullable();
                $table->smallInteger('sm_rec_status');
                $table->string('sm_rec_createdby',150);
                $table->dateTime('sm_rec_created');
                $table->string('sm_rec_updatedby',150)->nullable();
                $table->dateTime('sm_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('sm_rec_deletedby',150)->nullable();
                $table->dateTime('sm_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary('sm_id');
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
        Schema::dropIfExists('semesters');
    }
}
