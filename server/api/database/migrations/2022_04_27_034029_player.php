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
		Schema::create('player', function(Blueprint $table) {
			$table->id('player_id');
			$table->bigInteger('country_id')->unsigned();
			$table->foreign('country_id')
				->references('country_id')
			 	->on('country');
			$table->string('player_name');
			$table->timestamp('player_created_at');
			$table->timestamp('player_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('player');
    }
};
