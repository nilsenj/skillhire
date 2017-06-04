<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position')->default('');
            $table->decimal('salary')->default(0);
//            $table->longText('description')->default('');
            $table->longText('experience')->nullable();
            $table->longText('expectations')->nullable();
            $table->longText('achievement')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('experience_time', 2,1)->default(0);
            $table->string('main_trend')->default('');
            $table->string('second_trend')->default('');
            $table->string('english_skill')->default('');
            $table->string('location')->default('');
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
        Schema::dropIfExists('profiles');
    }
}
