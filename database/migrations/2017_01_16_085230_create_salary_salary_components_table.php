<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalarySalaryComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries_salary_components', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('value', 8, 2);
            $table->integer('salary_component_id')->unsigned();
            $table->integer('salary_id')->unsigned();
            $table->foreign('salary_component_id')->references('id')->on('salary_components')->onDelete('cascade');
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries_salary_components');
    }
}
