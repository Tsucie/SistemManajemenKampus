<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('payments'))
        {
            Schema::create('payments', function (Blueprint $table) {
                $table->integer('py_id')->unique('py_id_UNIQUE');
                $table->integer('py_mhs_id');//->index('fk_payments_mahasiswas');
                $table->string('py_code',20);
                $table->string('py_name',50);
                $table->decimal('py_value', 14, 2, true);
                $table->smallInteger('py_status');
                $table->string('py_paydate',20)->default('-');
                $table->string('py_paychannel',45)->default('-');
                $table->string('py_desc',255)->nullable();
                $table->smallInteger('py_rec_status');
                $table->string('py_rec_createdby',150);
                $table->dateTime('py_rec_created');
                $table->string('py_rec_updatedby',150)->nullable();
                $table->dateTime('py_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('py_rec_deletedby',150)->nullable();
                $table->dateTime('py_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary('py_id');
                $table->foreign('py_mhs_id', 'fk_payments_mahasiswas')->references('mhs_id')->on('mahasiswas')->onUpdate('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('payments');
    }
}
