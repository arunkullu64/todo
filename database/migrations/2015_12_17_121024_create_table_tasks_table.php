<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('title');
            $table->longText('description')->nullable();
            $table->dateTime('due_date');
            $table->enum('status',['new','progress','completed']);
            //$table->boolean('active')->default(true);
            
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
		Schema::drop('tasks');
	}

}