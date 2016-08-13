<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->index();
            $table->uuid('owner')->index();
            $table->uuid('assign')->index()->nullable();
            $table->text('service');
            $table->text('category');
            $table->text('detail');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner')->references('user_id')->on('users');
            $table->foreign('assign')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issues');
    }
}
