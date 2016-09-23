<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanttLinksTable extends Migration
{
	private $tables = [
		'gantt_links00000001',
		'gantt_links00000002',
		'gantt_links00000003',
	];

	private function createTable($name)
	{
		Schema::create($name, function(Blueprint $table) {
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
	}

    public function up()
    {
		$this->createTable('gantt_links');

		DB::table('gantt_links')->insert([
			['id' => 10,  'source' => 10, 'target' => 20,  'type' => '1'],
			['id' => 20,  'source' => 10, 'target' => 30,  'type' => '1'],
			['id' => 30,  'source' => 10, 'target' => 40,  'type' => '1'],
			['id' => 40,  'source' => 10, 'target' => 50,  'type' => '1'],
			['id' => 50,  'source' => 10, 'target' => 60,  'type' => '1'],
			['id' => 60,  'source' => 30, 'target' => 70,  'type' => '1'],
			['id' => 70,  'source' => 70, 'target' => 80,  'type' => '0'],
			['id' => 80,  'source' => 80, 'target' => 90,  'type' => '0'],
			['id' => 90,  'source' => 90, 'target' => 100, 'type' => '0'],
			['id' => 100, 'source' => 50, 'target' => 110, 'type' => '2'],
			['id' => 110, 'source' => 50, 'target' => 120, 'type' => '2'],
			['id' => 120, 'source' => 50, 'target' => 130, 'type' => '2'],
			['id' => 130, 'source' => 60, 'target' => 140, 'type' => '0'],
		]);

		DB::beginTransaction();
		foreach ($this->tables as $name) {
			$this->createTable($name);
			DB::statement('insert into '. $name .' select * from gantt_links');
		}
		DB::commit();
    }

    public function down()
    {
		Schema::drop('gantt_links');
    }
}
