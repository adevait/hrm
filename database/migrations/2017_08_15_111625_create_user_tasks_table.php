<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name');
            $table->string('task_description');
            $table->integer('assigned_to')->unsigned();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('due_date');
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
        Schema::dropIfExists('user_tasks');
    }
}
