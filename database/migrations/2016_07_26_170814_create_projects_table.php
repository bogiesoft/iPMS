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
			$table->date('end_date');
			$table->date('plan_start')->nullable();
			$table->date('plan_end')->nullable();
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

		DB::table('projects')->insert([
			['title' => 'PM1', 'product' => '',
			'start_date' => '', 'end_date' => '',
			'status' => 'Template', 'notes' => "Proto / ES / ES DQA / PP / PP DQA"],
			['title' => 'PM2', 'product' => '',
			'start_date' => '', 'end_date' => '',
			'status' => 'Template', 'notes' => "ES / ES DQA / PP / PP DQA"],
			['title' => 'PM3', 'product' => '',
			'start_date' => '', 'end_date' => '',
			'status' => 'Template', 'notes' => "ES / ES DQA / PP"],
			['title' => 'Test Project', 'product' => 'DR-1234',
			'start_date' => '2016-08-01', 'end_date' => '2016-12-30',
			'status' => 'Upcoming', 'notes' => "이거슨 TEST 프로젝트다."],
		]);
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
