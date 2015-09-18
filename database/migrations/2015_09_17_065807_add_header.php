<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('headers', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('header_type_id')->default(0);
            $table->string('data');
            $table->timestamp('deleted_at')->nullable();
            $table->nullableTimestamps();

        });

        Schema::create("advertisement", function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('ad_place_id')->default(0);
            $table->integer('ad_type_id')->default(0);
            $table->string('img_url')->nullable();
            $table->string('target_url')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create("bulletin", function(Blueprint $table){
            $table->increments('id');
            $table->string('data');
            $table->nullableTimestamps();
        });

        Schema::create("article", function(Blueprint $table){
            $table->increments('id');
            $table->integer('priority')->default(0);
            $table->string('title');
            $table->string('content');
            $table->integer('read')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->nullableTimestamps();

        });

        Schema::create("entrance", function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('target_url');
            $table->timestamp('deleted_at')->nullable();
            $table->nullableTimestamps();
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
