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
			$table->date('plan_start')->default('');
			$table->date('plan_end')->default('');
			$table->integer('level')->default(1);
			$table->integer('version')->default(0);
			$table->integer('status')->default(0);
			$table->integer('prev_id')->unsigned()->default(0);
			$table->integer('master_id')->unsigned()->default(0);
			$table->integer('pm_id')->unsigned()->default(0);
			$table->integer('prj_group')->default(0);
			$table->integer('dev_group')->default(0);
			$table->integer('budget')->default(0);
			$table->integer('approved')->default(0);
			$table->longText('notes')->nullable();
			$table->timestamps();

			$table->foreign('prev_id')
				->references('id')->on('projects')
				->onUpdate('cascade')
				->onDelete('cascade');
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
			'start_date' => '2000-01-01', 'end_date' => '2000-12-31',
			'level' => 1, 'status' => -1, 'notes' => "Proto / ES / ES DQA / PP / PP DQA"],
			['title' => 'PM2', 'product' => '',
			'start_date' => '2000-01-01', 'end_date' => '2000-12-31',
			'level' => 2, 'status' => -1, 'notes' => "ES / ES DQA / PP / PP DQA"],
			['title' => 'PM3', 'product' => '',
			'start_date' => '2000-01-01', 'end_date' => '2000-12-31',
			'level' => 3, 'status' => -1, 'notes' => "ES / ES DQA / PP"]
		]);
		DB::table('projects')->insert([
			['title' => 'Test Project', 'product' => 'DR-1234',
			'start_date' => '2016-08-01', 'end_date' => '2016-12-30',
			'plan_start' => '2016-08-01', 'plan_end' => '2016-12-30',
			'level' => 3, 'notes' => "이거슨 TEST 프로젝트다."],
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
