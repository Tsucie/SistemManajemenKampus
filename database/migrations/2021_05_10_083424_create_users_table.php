<?php

use Faker\Provider\DateTime;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('users'))
        {
            Schema::create('users', function (Blueprint $table) {
                $table->integer('u_id')->unique('u_id_UNIQUE');
                $table->integer('u_ut_id');//->index('fk_users_userTypes');
                $table->string('u_username',150)->unique('u_username_UNIQUE');
                $table->string('u_password');
                $table->dateTime('u_login_time')->default(now());
                $table->dateTime('u_logout_time')->default(now());
                $table->smallInteger('u_login_status')->default(0);
                $table->smallInteger('u_rec_status');
                $table->string('u_rec_createdby',150);
                $table->dateTime('u_rec_created');
                $table->string('u_rec_updatedby',150)->nullable();
                $table->dateTime('u_rec_updated')->default(date('0001-01-01 00:00:01'));
                $table->string('u_rec_deletedby',150)->nullable();
                $table->dateTime('u_rec_deleted')->default(date('0001-01-01 00:00:01'));
                $table->primary(['u_id','u_ut_id']);
                $table->foreign('u_ut_id', 'fk_users_userTypes')->references('ut_id')->on('user_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('users');
    }
}
