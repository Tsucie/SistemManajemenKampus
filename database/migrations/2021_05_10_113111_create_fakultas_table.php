<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('fakultas'))
        {
            Schema::create('fakultas', function (Blueprint $table) {
                $table->integer('fks_id')->unique('fks_id_UNIQUE');
                $table->string('fks_name',100);
                $table->string('fks_desc',255)->nullable();
                $table->smallInteger('fks_rec_status');
                $table->string('fks_rec_createdby',150);
                $table->dateTime('fks_rec_created');
                $table->string('fks_rec_updatedby',150)->nullable();
                $table->dateTime('fks_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('fks_rec_deletedby',150)->nullable();
                $table->dateTime('fks_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary('fks_id');
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
        Schema::dropIfExists('fakultas');
    }
}
