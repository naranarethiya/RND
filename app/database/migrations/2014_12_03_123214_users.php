<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($table) {
			$table->increments('uid');
			$table->string('name');
			$table->string('email');
			$table->string('mobile');
			$table->string('password');
			$table->string('temp');
			$table->rememberToken();
			$table->datetime('last_login');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('login_history',function($table) {
			$table->integer('uid');
			$table->string('ip');
			$table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('login_history');
	}

}
