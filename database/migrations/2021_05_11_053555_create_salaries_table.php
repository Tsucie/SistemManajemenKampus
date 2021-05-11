<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('salaries'))
        {
            Schema::create('salaries', function (Blueprint $table) {
                $table->integer('sal_id')->unique('sal_id_UNIQUE');
                $table->integer('sal_stf_id')->nullable()->index('fk_salaries_staff');
                $table->integer('sal_s_id')->nullable()->index('fk_salaries_sites');
                $table->string('sal_code',20);
                $table->string('sal_name',50);
                $table->decimal('sal_value', 14, 2, true);
                $table->string('sal_date',20)->default('-');
                $table->string('sal_channel',45)->default('-');
                $table->string('sal_desc',255)->nullable();
                $table->smallInteger('sal_rec_status');
                $table->string('sal_rec_createdby',150);
                $table->dateTime('sal_rec_created');
                $table->string('sal_rec_updatedby',150)->nullable();
                $table->dateTime('sal_rec_updated')->default(date('Y-m-d H:i:s'));
                $table->string('sal_rec_deletedby',150)->nullable();
                $table->dateTime('sal_rec_deleted')->default(date('Y-m-d H:i:s'));
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
        Schema::dropIfExists('salaries');
    }
}
