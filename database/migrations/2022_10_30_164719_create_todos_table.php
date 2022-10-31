<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task');
            $table->integer('status');
            $table->integer('date_list_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('todos', function($table) {
       $table->foreign('date_list_id')->references('id')->on('date_lists')->onDelete('cascade');;
   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
