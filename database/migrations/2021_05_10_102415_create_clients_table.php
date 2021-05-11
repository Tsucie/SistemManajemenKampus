<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('clients'))
        {
            Schema::create('clients', function (Blueprint $table) {
                $table->integer('c_id')->unique('c_id_UNIQUE');
                $table->integer('c_u_id')->index('fk_clients_users');
                $table->string('c_code',40)->unique('c_code_UNIQUE');
                $table->string('c_name', 150);
                $table->string('c_remark',150)->nullable();
                $table->smallInteger('c_rec_status');
                $table->string('c_rec_createdby',150);
                $table->dateTime('c_rec_created');
                $table->string('c_rec_updatedby',150)->nullable();
                $table->dateTime('c_rec_updated')->default(date('Y-m-d H:i:s'));
                $table->string('c_rec_deletedby',150)->nullable();
                $table->dateTime('c_rec_deleted')->default(date('Y-m-d H:i:s'));
                $table->primary(['c_id','c_u_id']);
                $table->foreign('c_u_id', 'fk_clients_users')->references('u_id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('clients');
    }
}
