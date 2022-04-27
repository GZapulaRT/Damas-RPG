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
		Schema::create('status', function(Blueprint $table) {
			$table->id('status_id');
			$table->bigInteger('player_id')->unsigned();
			$table->foreign('player_id')
				->references('player_id')
			 	->on('player');
			$table->string('status_current');
			$table->string('status_comment');
			$table->timestamp('status_created_at');
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('status');
    }
};
