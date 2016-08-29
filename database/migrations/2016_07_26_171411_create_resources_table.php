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
			$table->integer('type')->default(0);
            $table->integer('cost')->default(0);
            $table->integer('unit')->default(0);
			$table->text('notes')->nullable();
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
