<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanttTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('gantt_tasks', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('text');
			$table->datetime('start_date')->default('');
			$table->datetime('end_date')->default('');
			$table->integer('duration')->default(0);
			$table->float('progress')->default(0);
			$table->string('type')->default('task');
			$table->integer('parent')->unsigned();

			$table->foreign('parent')
				->references('id')->on('gantt_tasks')
				->onUpdate('cascade')
				->onDelete('cascade');
		});

		DB::table('gantt_tasks')->insert(
			['id' => 10, 'text' => 'Project #1', 'start_date' => '', 'type' => 'project', 'parent' => 0]);
		DB::table('gantt_tasks')->insert(
			['id' => 20, 'text' => 'Task #1', 'start_date' => '2016-08-03 00:00:00', 'duration' => 5, 'parent' => 10]);
		DB::table('gantt_tasks')->insert(
			['id' => 30, 'text' => 'Task #2', 'start_date' => '2016-08-03 00:00:00', 'parent' => 10]);
		DB::table('gantt_tasks')->insert(
			['id' => 40, 'text' => 'Task #3', 'start_date' => '2016-08-02 00:00:00', 'duration' => 6, 'parent' => 10]);
		DB::table('gantt_tasks')->insert(
			['id' => 50, 'text' => 'Task #4', 'start_date' => '2016-10-03 00:00:00', 'parent' => 10]);
		DB::table('gantt_tasks')->insert(
			['id' => 60, 'text' => 'Task #5', 'start_date' => '2016-08-12 00:00:00', 'duration' => 17, 'parent' => 10]);

		DB::table('gantt_tasks')->insert([
			['id' => 70, 'text' => 'Task #2.1', 'start_date' => '2016-08-03 00:00:00', 'duration' => 8, 'parent' => 30],
			['id' => 80, 'text' => 'Task #2.2', 'start_date' => '2016-08-06 00:00:00', 'duration' => 20, 'parent' => 30],
			['id' => 90, 'text' => 'Task #2.3', 'start_date' => '2016-08-10 00:00:00', 'duration' => 14, 'parent' => 30],
			['id' => 100, 'text' => 'Task #2.4', 'start_date' => '2016-08-10 00:00:00', 'duration' => 28, 'parent' => 30],
			['id' => 110, 'text' => 'Task #4.1', 'start_date' => '2016-10-03 00:00:00', 'duration' => 14, 'parent' => 50],
			['id' => 120, 'text' => 'Task #4.2', 'start_date' => '2016-10-03 00:00:00', 'duration' => 16, 'parent' => 50],
			['id' => 130, 'text' => 'Task #4.3', 'start_date' => '2016-10-03 00:00:00', 'duration' => 18, 'parent' => 50] ]);
		DB::table('gantt_tasks')->insert(
			['id' => 140, 'text' => 'Mielstone #6', 'start_date' => '2016-08-29 00:00:00', 'type' => 'milestone', 'parent' => 10]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('gantt_tasks');
    }
}
