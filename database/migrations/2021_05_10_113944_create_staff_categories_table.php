<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREATE TABLE IF NOT EXISTS
        if (!Schema::hasTable('staff_categories'))
        {
            Schema::create('staff_categories', function (Blueprint $table) {
                $table->integerIncrements('sc_id')->unique('sc_id_UNIQUE');
                $table->string('sc_name', 50);
                $table->string('sc_desc', 255)->nullable();
                $table->primary('sc_id');
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
        Schema::dropIfExists('staff_categories');
    }
}
