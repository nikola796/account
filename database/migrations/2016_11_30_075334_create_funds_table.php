<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->text('comment')->nullable();
            $table->integer('amount')->default(0);
            $table->tinyInteger('type');
            $table->timestamps();
            $table->timestamp('published_at');
            $table->integer('group_id')->nullable();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');

//            $table->foreign('group_id')
//                ->references('id')
//                ->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funds');
    }

}
