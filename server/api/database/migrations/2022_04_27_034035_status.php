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
			$table->id();
			$table->foreignId('user_id')->constrained();
            $table->string('status');
			$table->string('comment');
			$table->timestamp('created_at');
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
