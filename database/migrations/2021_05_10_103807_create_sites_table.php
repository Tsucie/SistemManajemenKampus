<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('sites'))
        {
            Schema::create('sites', function (Blueprint $table) {
                $table->integer('s_id')->unique('s_id_UNIQUE');
                $table->integer('s_u_id');
                $table->string('s_fullname',150);
                $table->string('s_remark',50);
                $table->string('s_nidn',20)->nullable();
                $table->string('s_nidk',20)->nullable();
                $table->string('s_nip',20)->nullable();
                $table->string('s_num_stat',8);
                $table->text('s_education');
                $table->text('s_experience');
                $table->string('s_address',255);
                $table->string('s_province',100);
                $table->string('s_city',100);
                $table->string('s_birthplace',100);
                $table->date('s_birthdate');
                $table->string('s_gender',20);
                $table->string('s_religion',50);
                $table->string('s_state',100);
                $table->string('s_email',50);
                $table->smallInteger('s_status');
                $table->string('s_contact',20);
                $table->smallInteger('s_rec_status');
                $table->string('s_rec_createdby',150);
                $table->dateTime('s_rec_created');
                $table->string('s_rec_updatedby',150)->nullable();
                $table->dateTime('s_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('s_rec_deletedby',150)->nullable();
                $table->dateTime('s_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary(['s_id','s_u_id']);
                $table->foreign('s_u_id', 'fk_sites_users')->references('u_id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('sites');
    }
}
