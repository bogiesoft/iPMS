<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('uid')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('fullname')->nullable();
            $table->integer('level')->default(-1);
            $table->rememberToken();
            $table->timestamps();
        });

		DB::table('users')->insert(
			['uid' => 'admin', 'password' => bcrypt('admin'), 'email' => 'ipms@idis.co.kr', 'fullname' => '관리자', 'level' => 9]);
		DB::table('users')->insert(
			['uid' => 'sjyun', 'password' => bcrypt('123456'), 'email' => 'sjyun@idis.co.kr', 'fullname' => '윤성진']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
