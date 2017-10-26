<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('title',200);
            $table->text('description');
            $table->string('status')->nullable();
            $table->integer('partner_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('complete_date')->nullable();
            $table->integer('progress')->default(0);
            $table->smallInteger('star')->default(0);
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
