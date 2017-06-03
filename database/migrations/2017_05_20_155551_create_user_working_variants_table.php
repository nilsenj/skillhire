<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWorkingVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('user_working_variants', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('working_variants_id');
            $table->primary(['user_id', 'working_variants_id']);
            $table->index(['user_id', 'working_variants_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_working_variants', function (Blueprint $table) {
            $table->dropPrimary('user_working_variants_user_id_primary');
            $table->dropPrimary('user_working_variants_working_variants_id_primary');
        });
    }
}
