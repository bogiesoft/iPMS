<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('projects', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('title');
			$table->string('product');
			$table->date('start_date');
			$table->date('due_date');
			$table->integer('version')->default(0);
			$table->string('status')->default('Upcoming');
			$table->integer('master_id')->unsigned()->default(0);
			$table->integer('pm_id')->unsigned()->default(0);
			$table->string('group')->nullable();
			$table->longText('notes')->nullable();
			$table->timestamps();

			$table->foreign('master_id')
				->references('id')->on('projects')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('pm_id')
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
		Schema::drop('projects');
    }
}
