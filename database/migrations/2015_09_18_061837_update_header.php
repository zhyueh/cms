<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table("headers", function(Blueprint $table){
            $table->dropColumn("data");
            $table->string("title")->nullable();
            $table->string("image")->nullable();
            $table->string("target_url")->nullable();
            $table->integer("display_order")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
