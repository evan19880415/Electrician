// app/database/seeds/UserTableSeeder.php

<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		//DB::table('users')->delete();
		User::create(array(
			'name'     => 'Chen470409',
			'username' => 'Chen470409',
			'email'    => 'chen470409@gmail.com',
			'password' => Hash::make('470409'),
		));
	}

}