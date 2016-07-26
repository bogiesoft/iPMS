<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('resources', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('name');
			$table->string('group');
			$table->string('position');
			$table->longText('notes')->nullable();
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
		Schema::drop('resources');
    }
}
