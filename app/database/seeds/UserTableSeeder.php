<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Naran Arethiya',
			'email'    => 'naranarethiya@gmail.com',
			'password' => Hash::make('abc123'),
			'temp_pass' => 'abc123',
			'mobile' => '8879331463',
			'created_at'=>date('Y-m-d H:i:s')
		));
	}
}

?>