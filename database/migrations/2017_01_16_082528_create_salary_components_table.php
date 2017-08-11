<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_components', function($table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('contract_type_id')->unsigned();
            $table->foreign('contract_type_id')->references('id')->on('contract_types')->onDelete('cascade');
            $table->tinyInteger('type');
            $table->tinyInteger('is_cost');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salary_components');
    }
}
