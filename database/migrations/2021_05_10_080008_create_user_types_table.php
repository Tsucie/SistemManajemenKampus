<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('user_types'))
        {
            Schema::create('user_types', function (Blueprint $table) {
                $table->integer('ut_id')->unique('ut_id_UNIQUE');
                $table->string('ut_name',45);
                $table->string('ut_desc',255)->nullable();
                $table->primary('ut_id');
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
        Schema::dropIfExists('user_types');
    }
}
