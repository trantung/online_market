<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('searchs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('price_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('time_id')->nullable();
            $table->string('lat', 256)->nullable();
            $table->string('long', 256)->nullable();
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
        Schema::drop('searchs');
	}

}
