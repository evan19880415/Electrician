// app/database/seeds/UserTableSeeder.php

<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		//DB::table('users')->delete();
		User::create(array(
			'name'     => 'Quest',
			'username' => 'quest',
			'email'    => 'quest@example.com',
			'password' => Hash::make('quest'),
		));
	}

}