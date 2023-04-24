<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('movie_requests')){
			Schema::create('movie_requests', function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('name', 191);
				$table->string('email', 191);
                $table->string('mr_name', 191);
                $table->timestamps();
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_requests');
    }
}
