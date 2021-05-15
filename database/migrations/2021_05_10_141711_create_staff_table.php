<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('staff'))
        {
            Schema::create('staff', function (Blueprint $table) {
                $table->integer('stf_id')->unique('stf_id_UNIQUE');
                $table->integer('stf_u_id');//->index('fk_staff_users');
                $table->integer('stf_sc_id');//->index('fk_staff_staffCategories');
                $table->integer('stf_fks_id')->nullable();//->index('fk_staff_fakultas');
                $table->integer('stf_ps_id')->nullable();//->index('fk_staff_programStudis');
                $table->integer('stf_mk_id')->nullable();//->index('fk_staff_mataKuliahs');
                $table->string('stf_fullname',150);
                $table->string('stf_nidn',20)->nullable();
                $table->string('stf_nidk',20)->nullable();
                $table->string('stf_nip',20)->nullable();
                $table->string('stf_nik',20)->nullable();
                $table->text('stf_education');
                $table->text('stf_experience');
                $table->string('stf_address',255);
                $table->string('stf_province',100);
                $table->string('stf_city',100);
                $table->string('stf_birthplace',100);
                $table->dateTime('stf_birthdate');
                $table->string('stf_gender',20);
                $table->string('stf_religion',50);
                $table->string('stf_state',100);
                $table->string('stf_email',50);
                $table->smallInteger('stf_status');
                $table->string('stf_contact',20);
                $table->smallInteger('stf_rec_status');
                $table->string('stf_rec_createdby',150);
                $table->dateTime('stf_rec_created');
                $table->string('stf_rec_updatedby',150)->nullable();
                $table->dateTime('stf_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('stf_rec_deletedby',150)->nullable();
                $table->dateTime('stf_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary('stf_id');
                $table->foreign('stf_u_id', 'fk_staff_users')->references('u_id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('stf_sc_id', 'fk_staff_staffCategories')->references('sc_id')->on('staff_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('stf_fks_id', 'fk_staff_fakultas')->references('fks_id')->on('fakultas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('stf_ps_id', 'fk_staff_programStudis')->references('ps_id')->on('program_studis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('stf_mk_id', 'fk_staff_mataKuliahs')->references('mk_id')->on('mata_kuliahs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('staff');
    }
}
