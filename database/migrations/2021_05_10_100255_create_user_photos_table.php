<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('user_photos'))
        {
            Schema::create('user_photos', function (Blueprint $table) {
                $table->integer('up_id')->unique('up_id_UNIQUE');
                $table->integer('up_u_id');//->index('fk_userPhotos_users');
                $table->binary('up_photo');
                $table->string('up_filename',150);
                $table->smallInteger('up_rec_status');
                $table->string('up_rec_createdby',150);
                $table->dateTime('up_rec_created');
                $table->string('up_rec_updatedby',150)->nullable();
                $table->dateTime('up_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('up_rec_deletedby',150)->nullable();
                $table->dateTime('up_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary(['up_id','up_u_id']);
                $table->foreign('up_u_id', 'fk_userPhotos_users')->references('u_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_photos');
    }
}
