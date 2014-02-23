<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountings', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', 255);
			$table->string('type', 255);
			$table->string('money_id', 255);
			$table->string('money_ref', 255);
			$table->integer('money');
			$table->date('created_date');
			$table->timestamps();
		});

		Schema::create('bank_accounts', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', 255);
			$table->string('account_number', 255);
			$table->timestamps();
		});

		Schema::create('bank_checks', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('account', 255);
			$table->string('check_number', 255);
			$table->date('created_date');
			$table->date('expired_date');
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
		Schema::drop('accountings');
		Schema::drop('bank_accounts');
		Schema::drop('bank_checks');
	}

}