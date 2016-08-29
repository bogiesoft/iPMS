<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('project_resources', function($table) {
			$table->increments('id')->unsigned();
			$table->integer('project_id')->unsigned();
			$table->integer('resource_id')->unsigned();
            $table->float('usage')->default(1);
			$table->timestamps();

			$table->foreign('project_id')
				->references('id')->on('projects')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('resource_id')
				->references('id')->on('resources')
				->onUpdate('cascade')
				->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('project_resources');
    }
}
