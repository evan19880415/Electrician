<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseinfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caseinfos', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('description', 255);
			$table->string('name', 255);
			$table->string('address', 255);
			$table->string('phone', 255);
			$table->string('mobile', 255);
			$table->integer('typeId');
			$table->integer('money');
			$table->integer('level');

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
		Schema::table('caseinfos', function(Blueprint $table)
		{
			//
			Schema::drop('caseinfos');
		});
	}

}