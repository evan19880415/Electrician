// app/database/seeds/UserTableSeeder.php

<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Evan.Chen',
			'username' => 'evan19880415',
			'email'    => 'evan19880415@gmail.com',
			'password' => Hash::make('770415'),
		));
	}

}