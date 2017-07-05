<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proposal_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('last_read');
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
        Schema::drop('participants', function(Blueprint $table) {
            $table->dropForeign('participants_proposal_id_foreign');
            $table->dropForeign('participants_user_id_foreign');
            $table->dropSoftDeletes();
        });
    }
}
