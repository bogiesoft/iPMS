<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanttLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('gantt_links', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->integer('source')->unsigned();
			$table->integer('target')->unsigned();
			$table->string('type');

			$table->foreign('source')
				->references('id')->on('gantt_tasks')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('target')
				->references('id')->on('gantt_tasks')
				->onUpdate('cascade')
				->onDelete('cascade');
		});

		DB::table('gantt_links')->insert([
			['id' => 10, 'source' => 10, 'target' => 20, 'type' => '1'],
			['id' => 20, 'source' => 10, 'target' => 30, 'type' => '1'],
			['id' => 30, 'source' => 10, 'target' => 40, 'type' => '1'],
			['id' => 40, 'source' => 10, 'target' => 50, 'type' => '1'],
			['id' => 50, 'source' => 10, 'target' => 60, 'type' => '1'],
			['id' => 60, 'source' => 30, 'target' => 70, 'type' => '1'],
			['id' => 70, 'source' => 70, 'target' => 80, 'type' => '0'],
			['id' => 80, 'source' => 80, 'target' => 90, 'type' => '0'],
			['id' => 90, 'source' => 90, 'target' => 100, 'type' => '0'],
			['id' => 100, 'source' => 50, 'target' => 110, 'type' => '2'],
			['id' => 110, 'source' => 50, 'target' => 120, 'type' => '2'],
			['id' => 120, 'source' => 50, 'target' => 130, 'type' => '2'],
			['id' => 130, 'source' => 60, 'target' => 140, 'type' => '0'],
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('gantt_links');
    }
}
