<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_education', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type');
            $table->integer('education_institution_id')->unsigned();
            $table->foreign('education_institution_id')->references('id')->on('education_institutions')
                ->onDelete('cascade');
            $table->string('major');
            $table->string('year', 10);
            $table->decimal('grade', 4, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('user_education');
    }
}
