<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('code', 256)->nullable();
            $table->string('name', 256)->nullable();
            $table->string('quantity_store', 256)->nullable();
            $table->integer('quantity_export')->nullable();
            $table->integer('status')->nullable();
            $table->string('image_url', 256)->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::drop('products');
	}

}
