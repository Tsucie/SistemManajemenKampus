<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('mahasiswas'))
        {
            Schema::create('mahasiswas', function (Blueprint $table) {
                $table->integer('mhs_id')->unique('mhs_id_UNIQUE');
                $table->integer('mhs_u_id');//->index('fk_mahasiswas_users');
                $table->integer('mhs_fks_id');//->index('fk_mahasiswas_fakultas');
                $table->integer('mhs_ps_id');//->index('fk_mahasiswas_programStudis');
                $table->string('mhs_fullname',150);
                $table->string('mhs_first_registered',20);
                $table->string('mhs_nim',20);
                $table->text('mhs_education')->nullable();
                $table->string('mhs_address',255);
                $table->string('mhs_province',100);
                $table->string('mhs_city',100);
                $table->string('mhs_birthplace',100);
                $table->dateTime('mhs_birthdate');
                $table->string('mhs_gender',20);
                $table->string('mhs_religion',50);
                $table->string('mhs_state',100);
                $table->string('mhs_email',50)->nullable();
                $table->smallInteger('mhs_status');
                $table->string('mhs_contact',20)->nullable();
                $table->string('mhs_ktp',20);
                $table->string('mhs_job',50)->nullable();
                $table->smallInteger('mhs_rec_status');
                $table->string('mhs_rec_createdby',150);
                $table->dateTime('mhs_rec_created');
                $table->string('mhs_rec_updatedby',150)->nullable();
                $table->dateTime('mhs_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('mhs_rec_deletedby',150)->nullable();
                $table->dateTime('mhs_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary(['mhs_id','mhs_u_id']);
                $table->foreign('mhs_u_id', 'fk_mahasiswas_users')->references('u_id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('mhs_fks_id', 'fk_mahasiswas_fakultas')->references('fks_id')->on('fakultas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('mhs_ps_id', 'fk_mahasiswas_programStudis')->references('ps_id')->on('program_studis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('mahasiswas');
    }
}
