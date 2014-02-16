// app/database/seeds/UserTableSeeder.php

<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		//DB::table('users')->delete();
		User::create(array(
			'name'     => 'Chen661102',
			'username' => 'Chen661102',
			'email'    => 'chen661102@gmail.com',
			'password' => Hash::make('661102'),
		));
	}

}