<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('score', function(Blueprint $table){
			$table->id('score_id');
			$table->bigInteger('player_id')->unsigned();
			$table->foreign('player_id')
				->references('player_id')
			 	->on('player');
			$table->string('score_change');
			$table->timestamp('score_created_at');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('score');
    }
};
