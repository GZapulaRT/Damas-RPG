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
        //
		Schema::create('rank', function(Blueprint $table){
			$table->id('rank_id');	
			$table->unsignedBigInteger('rank_player_id');
			$table->foreign('rank_player_id')
		 		->references('player_id')
				->on('player');
			$table->bigInteger('rank_current_score');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('rank');
    }
};
