<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('uid')->default(0);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->text('text');
            $table->timestamps();

            $table->foreign('uid')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        DB::table('schedules')->insert(
            ['start_date' => '2016-01-01 00:00', 'end_date' => '2016-01-02 00:00', 'text' => '신정']);
        DB::table('schedules')->insert(
            ['start_date' => '2016-08-01 00:00', 'end_date' => '2016-08-04 00:00', 'text' => '하계휴가']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}
