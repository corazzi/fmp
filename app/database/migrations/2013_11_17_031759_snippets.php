<?php

use Illuminate\Database\Migrations\Migration;

class Snippets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snippets', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('description');
			$table->string('state');
			$table->text('code_snippet');
			$table->bigInteger('user_id');
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
		//
	}

}